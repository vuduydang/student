@extends('layouts/index')
@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Student Add</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dash') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('students.index') }}">Students List</a></li>
            <li class="breadcrumb-item active">Students Adđ</li>
        </ol>
        <div class="card">
            <div class="card-header btn">
                <i class="fab fa-wpforms"></i>
                Form Add Student
            </div>
            <div class="card-body">
                {{Form::open(array('url'=>route('students.store'),'method'=>'post', 'files'=>true))}}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNam4">Name</label>
                            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>'Name']) }}
{{--                            <input type="text" name="name" class="form-control" id="inputName4" placeholder="Name">--}}
                            @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputBirthday4">Birthday</label>
                            {{ Form::date('birthday',null,['class'=>'form-control','id'=>'example-date-input']) }}
{{--                            <input class="form-control" name="birthday" type="date" id="example-date-input">--}}
                            @error('birthday')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputBirthday4">Gender</label>
                            {{ Form::select('gender', ['0' => 'Male','1' => 'Female'],null, ['class' => 'form-control', 'id'=>'inputState']) }}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputemail2">Email</label>
                            {{ Form::email('email',null,['class'=>'form-control','placeholder'=>'example@gmail.com']) }}
{{--                            <input type="email" name="email" class="form-control" id="inputEmail2" placeholder="example@gmal.com">--}}
                            @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPhone2">Phone Number</label>
                            {{ Form::text('phone',null,['class'=>'form-control','placeholder'=>'0123456789']) }}
{{--                            <input type="number" name="phone" class="form-control" id="inputPhone2" placeholder="0123456789">--}}
                            @error('phone')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputAddress">Addess</label>
                            {{ Form::text('address',null,['class'=>'form-control','placeholder'=>'Address']) }}
{{--                            <input type="text" name="address" class="form-control" id="inputAddress">--}}
                            @error('address')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputFile">Avatar</label> </br>
                            {{ Form::file('avatar',null,['class'=>'form-control-file','id'=>'exampleInputFile','aria-describedby'=>'fileHelp']) }}
{{--                            <input type="file" name="avatar" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">--}}
                            <small id="fileHelp" class="form-text text-muted">File phải có định dạng png hoặc jpg.</small>
                            @error('avatar')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputBirthday4">Course</label>
                            <select name="course_id"  id="inputState" class="form-control">
                                @foreach($courses as $cou)
                                    <option value="{{$cou->id}}">{{$cou->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Password (Default)</label>
                            <input type="password" name="password" readonly value="123456" class="form-control" id="inputPassword">
                            @error('password')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

