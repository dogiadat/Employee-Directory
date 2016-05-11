<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CheckEmployeeRequest;
use App\Employee;
use App\Department;

class EmployeesController extends Controller
{
    //
    public function index(){
    	$employee = Employee::all();
        $departments = Department::pluck('name', 'id');
    	return view('employees.employees', compact('departments'))-> with('employees',$employee);
    }
    public function create(){
        // $department = Department::all();
        $departments = Department::pluck('name', 'id');
        return view('employees.create', compact( 'departments'));
    }
    public function store(CheckEmployeeRequest $request){
        /*$input = new Employee();
        $input->name = $request->get('name');
        $input->department_id = $request->input('department_id');
        $input->email = $request->get('email');
        $input->job = $request->get('job');
        $input->phone = $request->get('phone');
        if($request->hasFile('avatar')){
            if($request->file('avatar')->isValid()){
                $input->photo = ''.time().rand(0, 1000);
                $request->file('avatar')->move(base_path().'/public/img', $input->photo);
            }
        }
        $input->save();
        return redirect('employees');*/
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->job = $request->job;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->department_id = $request->department_id;
        if($request->hasFile('avatar')){    
            if($request->file('avatar')->isValid()){
                $employee->photo = time().rand(0,1000);
                $request->file('avatar')->move(base_path().'/public/img',$employee->photo);
            }
        }
        $employee->save();
        return redirect('employees');
    }
    public function edit($id){
    	$employee = Employee::findOrFail($id);
        $departments = Department::pluck('name', 'id');
    	return view('employees.edit', compact('employee','departments'));
    }
    public function update($id,CheckEmployeeRequest $request){
    	$employee = Employee::findOrFail($id);
        $employee->name = $request->name;
        $employee->job = $request->job;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->department_id = $request->department_id;
        if($request->hasFile('avatar')){    
            if($request->file('avatar')->isValid()){
                if ($employee->photo == "") {
                    $employee->photo = time().rand(0,1000);
                }
                $request->file('avatar')->move(base_path().'/public/img',$employee->photo);
            }
        }
        $employee->update();
        return redirect('employees');
    }
    public function destroy($id){
    	$input = Employee::findOrFail($id);
    	$input->delete();
    	return redirect('employees');
    }

    public function show($id){
        $employee = Employee::find($id);
        return view('employees.profile', compact('employee'));
    }
    public function search(Request $request){
        if($request->department_id == "")
            $employees = Employee::where('name','like',"%$request->name%")->get();    
        else
            $employees = Employee::where('name','like',"%$request->name%")->where("department_id","$request->department_id")->get();
        $departments = Department::all();
        //return view('employees.employees',compact('employees','departments'));
        return view('employees.employees', compact('departments','employees'));
    }
}
