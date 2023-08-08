<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClassController extends Controller
{
    public function list(){
        $data['getRecord'] = ClassModel::getRecord();      
        $data['header_title'] = "Class List";
        return view('admin.class.list',$data);
    }

    public function add(){
        $data['header_title'] = "Add New Class List";
        return view('admin.class.add',$data);
    }
    public function insert(Request $request){
        $save = new ClassModel;
        $save->name = $request->name;
        $save->	status = $request->status;
        $save->created_by = Auth::user()->id;
        $save->save();
     return view('admin.class.list')->with('success',"Class Successfully Created");
    } 
    public function edit($id){
        $data['getRecord'] = ClassModel::getSingle($id);
        if(!empty($data['getRecord'])){
        $data['header_title'] = "Edit Class";
        return view('admin.class.edit',$data);
    }else {
        abort(404);
    }
}

public function update($id , Request $request){
   
    $save = ClassModel::getSingle($id);
    $save->name = $request->name;
    $save->	status = $request->status;
    $save->save();
     return view('admin.class.list')->with('success' , "Class Successfully Updated"); 
}
    public function delete($id){
        $user = ClassModel::getSingle($id);
        $user->in_delete = 1 ;
        $user->save();
        return view('admin.class.list')->with('success' , "Class Successfully deleted");
        }
}
