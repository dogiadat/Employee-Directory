@extends('layouts.app')

@section('content')
<div class="container">
    @if(!Auth::guest())
    <div class="panel panel-primary" style="border-color:#0089FF">
        <div class="panel-body">
            <a href="{{url('employees/create')}}" class='btn btn-info btn-lg' role='button'> <i class="glyphicon glyphicon-plus"></i> Thêm nhân viên</a>
        </div>
    </div>
    @endif
        <div>
            <form action="{{url('employees/search')}}" method="get" role='search' accept-charset="utf-8">
                <input type="text" name='name' placeholder="Tên nhân viên">
                <select name="department_id" id="department_id">
                    <option value="">Phòng ban</option>
                    @foreach(app\Department::all() as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-success">Tìm kiếm</button>
            </form>
        </div>
        <div>
            <h3>Nhân viên</h3>
            <div class="panel panel-primary">
	            @if(count($employees)>0)
	            <table class="table table-hover">
	                 <thead style="background: grey; color:#fff;">
	                     <tr>
	                         <th>Tên nhân viên</th>
	                         <th>Công việc</th>
	                         <th>Email</th>
	                         <th>Phòng ban</th>
	                        @if(Auth::check())
	                            <th><th>
	                        @endif
	                     </tr>
	                 </thead>
	                 <tbody>
	                    @foreach($employees as $employee)
	                        <tr>
	                            <td><a href="{{url('employees/'.$employee->id)}}">{{$employee->name}}</a></td>
	                            <td>{{$employee->job}}</td>
	                            <td>{{$employee->email}}</td>
	                            <td>{{$employee->department->name}}</td>
	                            @if(Auth::check())
	                                <td>
	    <!--                                 <a href="demo/{{$employee->id}}/edit" class='btn-info btn-xs' role='button'>Sửa</a> -->
	                                    
	                                      <!--   {!! csrf_field() !!} -->
	                                      <div class="form-group">
	                                        
	                                    <form action="{{url('employees/'.$employee->id)}}" method="POST">
	                                        {!! csrf_field() !!}
	                                        {!! method_field('DELETE') !!}
	                                        <a href="{{url('employees/'.$employee->id.'/edit')}}" class="btn btn-info btn-xs">
	                                            <span class="glyphicon glyphicon-pencil">
	                                            </span>Sửa
	                                        </a>
	                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal">
	                                             <span class="glyphicon glyphicon-remove"></span> Xóa
	                                        </button>
	                                        <div class="modal fade" id="myModal" role="dialog">
										    	<div class="modal-dialog">
										    
										      	<!-- Modal content-->
										      	<div class="modal-content">
											        <div class="modal-header"  style="background: #0089FF; color:#fff">
											          <button type="button" class="close" data-dismiss="modal">&times;</button>
											          <h4 class="modal-title">Xóa nhân viên</h4>
											        </div>
											        <div class="modal-body">
											          <p>Bạn chắc chắn muốn xóa nhân viên không?</p>
											        </div>
											        <div class="modal-footer" align="center">
											        	<button type="submit" class="btn btn-danger">Yes</button>
											          	<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
											        </div>
										      	</div>
										      
										    </div>
										  </div>
	                                    </form>
	                                    </div>
	                                </td>
	                            @endif
	                        </tr>
	                    @endforeach
	                 </tbody>
	             </table>
	             @else
	                <div class="panel-body">
	                    <b>Không có nhân viên nào</b> 
	                </div>
	             @endif
            </div>
        </div>

</div>
@endsection
