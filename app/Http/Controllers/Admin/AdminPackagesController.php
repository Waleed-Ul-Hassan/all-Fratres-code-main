<?php

namespace App\Http\Controllers\Admin;

use App\Package;
use App\PackageFeature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPackagesController extends Controller
{
    public function packageFeature() {

        $packages = PackageFeature::all();

        return view('admin.package-features.index', compact('packages'));
    }

    public function addPackageFeature(Request $request) {


        return view('admin.package-features.add');
    }

    public function savePackageFeature(Request $request) {

        $response = array();
        $packages = new PackageFeature();
        $packages->name = $request->name;

        $result = $packages->save();

        if ($result > 0) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }

    public function editPackageFeature($id) {

        $edit = PackageFeature::find($id);

        return view('admin.package-features.update', compact('edit'));

    }


    public function updatePackageFeature(Request $request) {

        $response = array();
        $id = $request->id;
        $packages = PackageFeature::find($id);
        $packages->name = $request->name;

        $result = $packages->save();

        if ($result > 0) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }

    public function deletePackageFeature(Request $request, $id) {

        $response = array();
        $packages = PackageFeature::find($id)->delete();

        if ($packages) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }

    public function packages() {

        $packages = Package::all();

        return view('admin.packages.index', compact('packages'));
    }

    public function addPackages(Request $request) {

        $features = PackageFeature::all();

        return view('admin.packages.add', compact('features'));
    }

    public function savePackages(Request $request) {

        $response = array();
        $packages = new Package();
        $packages->name = $request->name;
        $packages->jobs = $request->jobs;
        $packages->price = $request->price;
        if( $request->features != '' ){
            $packages->features = json_encode($request->features);
        }

        $result = $packages->save();

        if ($result > 0) {
            return redirect('/admin/packages')->with('message', 'Added Successfully');
        } else {
            return redirect('/admin/packages')->with('message', 'Added Successfully');
        }

    }

    public function editPackages($id) {

        $edit = Package::find($id);
        $features = PackageFeature::all();
        $fe = json_decode($edit->features);

        return view('admin.packages.update', compact('edit','features','fe'));

    }


    public function updatePackages(Request $request) {

        $response = array();
        $id = $request->id;
        $packages = Package::find($id);
        $packages->name = $request->name;
        $packages->jobs = $request->jobs;
        $packages->price = $request->price;
        if( $request->features != '' ){
            $packages->features = json_encode($request->features);
        }
//        $packages->features = json_encode($request->features);

        $result = $packages->save();

        if ($result > 0) {
            return redirect('/admin/packages')->with('message', 'Added Successfully');
        } else {
            return redirect('/admin/packages')->with('message', 'Added Successfully');
        }

    }

    public function deletePackages(Request $request, $id) {

        $response = array();
        $packages = Package::find($id)->delete();

        if ($packages) {
            return redirect('/admin/packages')->with('message', 'Added Successfully');
        } else {
            return redirect('/admin/packages')->with('message', 'Added Successfully');
        }
    }

}
