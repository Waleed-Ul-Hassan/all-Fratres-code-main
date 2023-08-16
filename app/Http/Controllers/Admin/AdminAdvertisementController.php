<?php

namespace App\Http\Controllers\Admin;

use App\Advertisement;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Image;

class AdminAdvertisementController extends Controller
{
    public function show(Request $request) {

        $advertisement = Advertisement::all();

        return view('admin.advertisement.index', compact('advertisement'));
    }

    public function add(Request $request) {


        return view('admin.advertisement.add');
    }


    public function create(Request $request) {

        $advertisement = new Advertisement();
        $advertisement->title = $request->title;
        $advertisement->placement_key = $request->placement_key;
        $advertisement->url = $request->url;


        if ($request->hasFile('advertisement')) {

            $imageName = time() . '.' . request()->advertisement->getClientOriginalExtension();

            request()->advertisement->move(public_path('advertisement'), $imageName);


            $advertisement->image = $imageName;
        }


        $result = $advertisement->save();

        return redirect('admin/advertisement')->with('message', 'Advertisement Added');

    }

    public function edit($id) {

        $edit = Advertisement::find($id);

        return view('admin.advertisement.update', compact('edit'));

    }


    public function update(Request $request) {

        $response = array();
        $id = $request->id;
        $advertisement = Advertisement::find($id);
        $advertisement->title = $request->title;
        $advertisement->placement_key = $request->placement_key;
        $advertisement->url = $request->url;



        $path = asset('advertisement/' . $advertisement->image);

        if (File::exists($path)) {
            File::delete($path);
        }

        if ($request->hasFile('advertisement')) {

            $imageName = time() . '.' . request()->advertisement->getClientOriginalExtension();

            request()->advertisement->move(public_path('advertisement'), $imageName);


            $advertisement->image = $imageName;
        }


        $result = $advertisement->save();


        return redirect('admin/advertisement')->with('message', 'Advertisement Added');

    }

    public function delete(Request $request, $id) {

        $response = array();
        $edit = Advertisement::find($id);
        $abc = Storage::delete($edit->image);
        $edit->delete();

        if ($edit) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }

    public function active(Request $request, $id) {

        $response = array();
        $edit = Advertisement::find($id);
        $edit->status = 'active';

        $edit->save();


        if ($edit) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }

    public function pause(Request $request, $id) {

        $response = array();
        $edit = Advertisement::find($id);
        $edit->status = 'pause';

        $edit->save();

        if ($edit) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }
}
