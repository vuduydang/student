@extends('layouts.index')
@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {!! Session::get('success') !!}
        </div>
    @endif
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">{{__('messages.Student-list')}}</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('dash') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">{{__('messages.Student-list')}}</li>
            </ol>
            <!--filter-->
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                {!! Form::open(['method'=>'GET']) !!}
                <div class="navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link p-3 border text-info d-inline" href="{{ route('students.create') }}">
                                <i class="fas fa-plus"></i>
                            </a>
                        </li>
                        <li class="nav-item border-right ml-2"></li>
                    </ul>
                    <div class="row">
                        <div class="text-secondary p-3">
                            <h3>{{__('messages.Phone')}}</h3>
                            <div class="form-group">
                                {!! Form::checkbox('phone[]','viettel',$request->has('phone')?in_array('viettel', $request->phone):false,['id'=>'phone1','class'=>'filter-phone']) !!}
                                {!! Form::label('phone1', 'Viettel') !!}
                            </div>
                            <div class="form-group">
                                {!! Form::checkbox('phone[]','vinaphone',$request->has('phone')?in_array('vinaphone', $request->phone):false,['id'=>'phone2','class'=>'filter-phone']) !!}
                                {!! Form::label('phone2', 'Vinaphone') !!}
                            </div>
                            <div class="form-group">
                                {!! Form::checkbox('phone[]','mobifone',$request->has('phone')?in_array('mobifone', $request->phone):false,['id'=>'phone3','class'=>'filter-phone']) !!}
                                {!! Form::label('phone3', 'Mobifone') !!}
                            </div>
                        </div>
                        <div class="text-secondary p-3">
                            <h3>{{__('messages.Age')}}</h3>
                            <div class="form-group">
                                {!! Form::number('age_min',$request->age_min,['class'=>'form-control filter-age','placeholder' => 'min']) !!}
                                @error('age_min')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <p> to :</p>
                            <div class="form-group">
                                {!! Form::number('age_max',$request->age_max,['class'=>'form-control filter-age','placeholder' => 'max']) !!}
                                @error('age_max')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-secondary p-3">
                            <h3>{{__('messages.Score')}}</h3>
                            <div class="form-group">
                                {!! Form::number('score_min',$request->score_min,['class'=>'form-control filter-score','placeholder' => 'min']) !!}
                                @error('score_min')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <p> to :</p>
                            <div class="form-group">
                                {!! Form::number('score_max',$request->score_max,['class'=>'form-control filter-score','placeholder' => 'max']) !!}
                                @error('score_max')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-secondary p-3">
                            <h3>{{__('messages.Status')}}</h3>
                            <div class="form-group">
                                {!! Form::radio('status','Passed',$request->status == 'Passed',['id'=>'status1','class'=>'filter-status']) !!}
                                {!! Form::label('status1', __('messages.Passed')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::radio('status','Studying',$request->status == 'Studying',['id'=>'status2','class'=>'filter-status']) !!}
                                {!! Form::label('status2', __('messages.Studying')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::radio('status','Failed',$request->status == 'Failed',['id'=>'status3','class'=>'filter-status']) !!}
                                {!! Form::label('status3', __('messages.Failed')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="d-inline ml-4">
                        {!! Form::submit('Filter',['class'=>'btn btn-primary','name'=>'filter']) !!}
                    </div>
                </div>

                <div id="action">
                    <span>Tags:</span>
                    <div class="tags d-inline">
                        @if($request->has('phone'))
                            @foreach($request->phone as $tag)
                                <span class="text-primary tag-{{$tag}}"><i class="fas fa-tag"></i> {{$tag}}</span>
                            @endforeach
                        @endif
                        @if($request->score_min + $request->score_max > 0)
                            <span class="text-primary tag-score"><i class="fas fa-tag"></i> score</span>
                        @endif
                        @if($request->age_min + $request->age_max > 0)
                            <span class="text-primary tag-age"><i class="fas fa-tag"></i> age</span>
                        @endif
                        @if($request->has('status'))
                                <span class="text-primary tag-{{$request->status}}"><i class="fas fa-tag"></i> {{__('messages.'.$request->status)}}</span>
                        @endif
                    </div>
                    <div class="clear-filter d-inline-block p-2">
                        <span> | </span>
                        <a href="{{ route('students.index') }}" class="text-info">all</a>
                    </div>
                </div>
                {{ Form::close() }}
            </nav>
            <!--end filter-->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    DataTable Students
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead id="table" data-url="/students">
                            <tr>
                                <th>ID</th>
                                <th>{{__('messages.Name')}}</th>
                                <th>{{__('messages.Phone')}}</th>
                                <th>Email</th>
                                <th>{{__('messages.Course')}}</th>
                                <th>{{__('messages.Score')}}</th>
                                <th>{{__('messages.Avatar')}}</th>
                                <th>{{__('messages.Birthday')}}</th>
                                <th>{{__('messages.Status')}}</th>
                                <th>{{__('messages.Option')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $index => $student)
                                <tr id="row-{{ $student->id }}">
                                    <td>{{$student->id}}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->phone }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->course->name??'--Underfined--'}}</td>
                                    <td>{{ $student->avg_score}}</td>
                                    <td>
                                        <img src="{{ asset("/images/avatars/" . $student->avatar) }}" class="rounded mx-auto d-block" width="40" alt="avatar">
                                    </td>
                                    <td>{{ $student->birthday}}</td>
                                    <td class="text-center">
                                        @if($student->status == 0)
                                            <span class="text-info">{{__('messages.Studying')}}</span>
                                        @elseif($student->status == 1)
                                            <span class="text-success">{{__('messages.Passed')}}</span>
                                        @elseif($student->status == -1)
                                            <span class="text-secondary">{{__('messages.Failed')}}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('students.edit',$student) }}" class="p-2 text-info">
                                            <i class="fas fa-user-edit"></i>
                                        </a>
                                        <a href="{{ route('students.subject',$student) }}" class="p-2 text-success">
                                            <i class="fas fa-book-reader"></i>
                                        </a>
                                        <a href="#" onclick="remove({{ $student->id }})" class="p-2 text-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $students->appends($request->all())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
