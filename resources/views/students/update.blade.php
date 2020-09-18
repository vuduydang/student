@extends('layouts/index')
@section('content')
    <div class="container-fluid">
        @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {!! Session::get('error') !!}
            </div>
        @endif
        <h1 class="mt-4">{{__('messages.Student-detail')}}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dash') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('students.index') }}">{{__('messages.Student-list')}}</a></li>
            <li class="breadcrumb-item active">{{__('messages.Student-detail')}}</li>
        </ol>
        <div class="card">
            <div class="card-header btn bg-info" data-toggle="collapse" data-target="#updateStudent">
                <i class="fab fa-wpforms"></i>
                {{__('messages.Student-detail')}}
            </div>
            <div class="card-body collapse show" data-toggle="collapse" aria-expanded="false" id="updateStudent">
                {!! Form::open(['method'=>'PUT','url' => route('students.update', $student),'files'=>true]) !!}
                <input type="hidden" name="user_id" value="{{$student->user_id}}"/>
                <input type="hidden" name="id" value="{{$student->id}}"/>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNam4">{{__('messages.Name')}}</label>
                        {{ Form::text('name',$student->name,['class'=>'form-control','placeholder'=>'Name']) }}
                        @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputBirthday4">{{__('messages.Birthday')}}</label>
                        {{ Form::date('birthday',$student->birthday,['class'=>'form-control','id'=>'example-date-input']) }}
                        @error('birthday')
                        <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputBirthday4">{{__('messages.Gender')}}</label>
                        {{ Form::select('gender', ['0' => __('messages.Male'),'1' => __('messages.Female')],$student->gender, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputemail2">Email</label>
                        {{ Form::email('email',$student->email,['class'=>'form-control','placeholder'=>'example@gmail.com']) }}
                        @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPhone2">{{__('messages.Phone')}}</label>
                        {{ Form::number('phone',$student->phone,['class'=>'form-control','placeholder'=>'0123456789']) }}
                        @error('phone')
                        <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputAddress">{{__('messages.Address')}}</label>
                        {{ Form::text('address',$student->address,['class'=>'form-control','placeholder'=>'Address']) }}
                        @error('address')
                        <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputFile">{{__('messages.Avatar')}}</label>
                        <input type="hidden" name="avatarDefault" value="{{ $student->avatar }}">
                        <input type="file" name="avatar" class="form-control-file" id="exampleInputFile"
                               aria-describedby="fileHelp">
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
                        <label for="inputBirthday4">{{__('messages.Course')}}</label>
                        <select name="course_id" id="inputState" class="form-control">
                            <option value="0">--Underfined--</option>
                            @foreach($courses as $cou)
                                @if($student->course_id == $cou->id)
                                    <option value="{{$cou->id}}" selected>{{$cou->name}}</option>
                                @else
                                    <option value="{{$cou->id}}">{{$cou->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputBirthday4">{{__('messages.Avatar')}}</label>
                        <img src="{{ asset('images/avatars') .'/'. $student->avatar }}" class="border" width="80">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="status">{{__('messages.Status')}}</label>
                        {{ Form::select('status', ['1'=>__('messages.Passed'),'0' => __('messages.Studying'),'-1' => __('messages.Failed')],$student->status, ['class' => 'form-control']) }}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

