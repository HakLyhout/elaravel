<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class CategoriesController extends Controller
{
    public function index()
    {
        $this->AdminAuthCheck();
    	return view('admin.categories');
    }
    public function all_categories()
    {
        $this->AdminAuthCheck();
    	$all_category_info = DB::table('tbl_category')->get();
    	$manage_category = view('admin.all_categories')
    	->with('all_category_info',$all_category_info);

    	return view('admin_layout')->with('admin.all_categories',$manage_category);
    	// return view('admin.all_categories');
    }
    public function save_categories(Request $request)
    {
    	$data = array();
    	$data['id'] = $request->id;
    	$data['category_name'] = $request->category_name;
    	$data['category_description'] = $request->category_description;
    	$data['publication_status'] = $request->publication_status;

    	DB::table('tbl_category')->insert($data);
    	Session::put('message','Categories added Successfully !');
    	return Redirect::to('/categories');

    }
    public function unactive_categories($id)
    {
    	DB::table('tbl_category')
    	->where('id',$id)
    	->update(['publication_status'=>0]);
    	Session::put('message','This Category is Unactive !!');
    	return Redirect::to('/all-categories');
    }

    public function active_categories($id)
    {
    	DB::table('tbl_category')
    	->where('id',$id)
    	->update(['publication_status'=>1]);
    	Session::put('message','This Category is active !!');
    	return Redirect::to('/all-categories');
    }
    
    public function edit_categories($id)
    {
    	$category_info = DB::table('tbl_category')
    		->where('id',$id)
    		->first();
    	$category_info = view('admin.edit_categories')
    		->with('category_info',$category_info);
    	return view('admin_layout')
    		->with('admin.edit_categories',$category_info);
    	//return view('admin.edit_categories');
    }
    public function update_categories(Request $request,$id)
    {
    	$data = array();
    	$data['category_name'] = $request->category_name;
    	$data['category_description'] = $request->category_description;

    	DB::table('tbl_category')
    		->where('id',$id)
    		->update($data);

    	Session::put('message','This Category is updated');
    	return Redirect::to('/all-categories');
    }
    public function delete_categories($id)
    {
    	DB::table('tbl_category')
    		->where('id',$id)
    		->delete();
    	Session::get('message','Categories Deleted Successfully');
    	return Redirect::to('/all-categories');
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
