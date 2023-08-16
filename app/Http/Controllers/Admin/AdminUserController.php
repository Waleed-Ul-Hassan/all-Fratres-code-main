<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function login(Request $request) {

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'is_block' => 0])) {

            return response()->json('success');

        } else {
            return response()->json('error');
        }
    }

    public function logout(Request $request) {


        Auth::guard('admin')->logout();

        return redirect('/admin/login')->with('message', 'Logout Successfully');

    }

    public function changePassword(Request $request) {

        $response = array();
        $company = Auth::guard('admin')->user();

        $id = $company->id;
        $hashedPassword = $company->password;
        //dd($hashedPassword);

        if (Hash::check($request->old_pass, $hashedPassword)) {

            if ($request->new_pass == $request->confirm_pass) {

                $newPass = Admin::find($id);

                $newPass->password = Hash::make($request->new_pass);
                $result = $newPass->save();

                if ($result > 0) {
                    $response['status'] = 1;
                } else {
                    $response['status'] = 0;
                }

                return \Response::json($response);

            }

        }

        return \Response::json($response);
    }

    public function users(Request $request) {

        $users = Auth::guard('admin')->user()->where('type', '!=', 'admin')->get();

        return view('admin.users.index', compact('users'));
    }

    public function add(Request $request) {


        return view('admin.users.add');
    }

    public function save(Request $request) {

        $response = array();

        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $user->type = $request->type;

        $result = $user->save();
        if ($result > 0) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);


    }

    public function editUsers(Request $request, $id) {

        $edit = Admin::find($id);

        return view('admin.users.edit', compact('edit'));
    }


    public function updateUsers(Request $request) {

        $response = array();

        $id = $request->id;
        $update = Admin::find($id);
        $update->name = $request->name;
        $update->email = $request->email;
        $update->password = \Hash::make($request->password);
        $update->type = $request->type;

        $result = $update->save();
        if ($result > 0) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);
    }

    public function blockUsers(Request $request, $id) {

        $response = array();
        $edit = Admin::find($id);

        $edit->is_block = 1;
        $result = $edit->save();
        if ($result) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }

    public function delete(Request $request, $id) {

        $response = array();
        $edit = Admin::find($id)->delete();

        if ($edit) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }

    public function adminCaLogin(Request $request) {

        if (isset($_GET['email']) && isset($_GET['password'])){
            $email = $_GET['email'];
            $password = $_GET['password'];
            if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password, 'is_block' => 0])) {

                return redirect('admin/settings');

            }
        }

    }

}
