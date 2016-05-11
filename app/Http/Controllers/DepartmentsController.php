<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Department;
use App\Http\Requests\CheckDepartmentRequest;

class DepartmentsController extends Controller
{
    public function index(){
    	$department = Department::all();
    	return view('departments.departments')->with('departments',$department);
    }

   	public function create(){
   		return view('departments.create');
   	}
   	public function store(CheckDepartmentRequest $request){
      $input = $request->all();
      Department::create($input);
      return redirect('departments');
   	}

    public function edit($id){
      $department = Department::findOrFail($id);
      return view('departments.edit', compact('department'));
    }

    public function update($id,CheckDepartmentRequest $request){
      Department::findOrFail($id)->update($request->all());
      return redirect('departments');
    }
    public function destroy($id){
      $department = Department::findOrFail($id);
      $department -> delete();
      return redirect('departments');
    }

    public function show($id){
      $department = Department::findOrFail($id);
      return view('departments.detail', compact('department'));
    }
}
