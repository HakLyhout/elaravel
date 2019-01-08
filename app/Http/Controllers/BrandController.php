<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class BrandController extends Controller
{
   	 public function index()
    {
        $this->AdminAuthCheck();
    	return view('admin.brand');
    }
    public function all_brand()
    {
        $this->AdminAuthCheck();
    	$all_brand_info = DB::table('tbl_manufacture')->get();
    	$manage_brand = view('admin.all_brand')
    	->with('all_brand_info',$all_brand_info);

    	return view('admin_layout')->with('admin.all_brand',$manage_brand);
    	// return view('admin.all_categories');
    }
    public function save_brand(Request $request)
    {
    	$data = array();
    	$data['manufacture_id'] = $request->manufacture_id;
    	$data['manufacture_name'] =  $request->brand_name;
    	$data['manufacture_description'] = $request->brand_description;
    	$data['publication_status'] = $request->publication_status;

    	DB::table('tbl_manufacture')->insert($data);
    	Session::put('message','Brand added Successfully !');
    	return Redirect::to('/brand');

    }
    public function unactive_brand($manufacture_id)
    {
    	DB::table('tbl_manufacture')
    	->where('manufacture_id',$manufacture_id)
    	->update(['publication_status'=>0]);
    	Session::put('message','This Brand is Unactive !!');
    	return Redirect::to('/all-brand');
    }

    public function active_brand($manufacture_id)
    {
    	DB::table('tbl_manufacture')
    	->where('manufacture_id',$manufacture_id)
    	->update(['publication_status'=>1]);
    	Session::put('message','This Brand is active !!');
    	return Redirect::to('/all-brand');
    }
    
    public function edit_brand($manufacture_id)
    {
    	$brand_info = DB::table('tbl_manufacture')
    		->where('manufacture_id',$manufacture_id)
    		->first();
    	$brand_info = view('admin.edit_brand')
    		->with('brand_info',$brand_info);
    	return view('admin_layout')
    		->with('admin.edit_brand',$brand_info);
    	//return view('admin.edit_categories');
    }
    public function update_brand(Request $request,$manufacture_id)
    {
    	$data = array();
    	$data['manufacture_name'] = $request->brand_name;
    	$data['manufacture_description'] = $request->brand_description;

    	DB::table('tbl_manufacture')
    		->where('manufacture_id',$manufacture_id)
    		->update($data);

    	Session::put('message','This Brand is updated');
    	return Redirect::to('/all-brand');
    }
    public function delete_brand($manufacture_id)
    {
    	DB::table('tbl_manufacture')
    		->where('manufacture_id',$manufacture_id)
    		->delete();
    	Session::get('message','Brand Deleted Successfully');
    	return Redirect::to('/all-brand');
    }
    public function AdminAuthCheck()
    {
        $admin_id = Session::get('admin_id');
        if($admin_id)
        {
            return;
        }else
        {
            return Redirect::to('/admin')->send();
        }
    }
}
