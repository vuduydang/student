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
                <form method="post" action="{{ route('students.update', $student) }}" enctype="multipart/form-data" >
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="user_id" value="{{$student->user_id}}"/>
                    <input type="hidden" name="id" value="{{$student->id}}"/>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNam4">{{__('messages.Name')}}</label>
                            <input type="text" name="name" value="{{$student->name}}" class="form-control" id="inputName4" placeholder="Name">
                            @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputBirthday4">{{__('messages.Birthday')}}</label>
                            <input class="form-control"  value="{{$student->birthday}}" name="birthday" type="date" id="example-date-input">
                            @error('birthday')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputBirthday4">{{__('messages.Gender')}}</label>
                            <select name="gender" id="inputState" class="form-control">
                                @if($student->gender == 0)
                                    <option value="0" selected>{{__('messages.Male')}}</option>
                                    <option value="1">{{__('messages.Female')}}</option>
                                @else
                                    <option value="0">{{__('messages.Male')}}</option>
                                    <option value="1" selected>{{__('messages.Female')}}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputemail2">Email</label>
                            <input type="email" name="email" value="{{$student->email}}" class="form-control" id="inputEmail2" placeholder="example@gmal.com">
                            @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPhone2">{{__('messages.Phone')}}</label>
                            <input type="number" name="phone" value="{{$student->phone}}" class="form-control" id="inputPhone2" placeholder="0123456789">
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
                            <input type="text" name="address" value="{{$student->address}}" class="form-control" id="inputAddress">
                            @error('address')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputFile">{{__('messages.Avatar')}}</label>
                            <input type="hidden" name="avatarDefault" value="{{ $student->avatar }}">
                            <input type="file" name="avatar" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
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
                            <select name="course_id"  id="inputState" class="form-control">
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
                        <div class="form-group col-md-6">
                            <label for="inputBirthday4">{{__('messages.Avatar')}}</label>
                                <img src="{{ asset('images/avatars') .'/'. $student->avatar }}" class="border" width="80">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

