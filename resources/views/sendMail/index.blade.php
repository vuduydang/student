@extends('layouts.index')
@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">{{__('messages.Mailler')}}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dash') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">{{__('messages.Mailler')}}</li>
        </ol>
        <!--filter-->
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Custom</button>
                    </li>
                </ul>
            </div>
        </nav>
        <hr/>
        {{ Form::open(['url' => route('email.store'), 'method' => 'POST', 'class' => 'form-horizontal form-label-left']) }}
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="jp_cp_right_side_wrapper">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{Form::text('email',null,['placeholder'=>'Email' , 'class'=>'form-control'])}}
                            @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{Form::text('name',null,['placeholder'=>'Name' , 'class'=>'form-control'])}}
                            @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{Form::text('title',null,['placeholder'=>'Title' , 'class'=>'form-control'])}}
                            @error('title')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        {{Form::textarea('content',null,['placeholder'=>'Content' , 'class'=>'form-control'])}}
                        @error('content')
                        <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                </div>
                <div></div>
                <div class="form-group">
                    <div class="col-md-12 col-sm-6 col-xs-12 col-md-offset-3">
                        {{ Form::button(__('Send Mail'), ['type' => 'submit','class' => 'btn btn-success'] ) }}
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}

    <!--Modal-->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-3">
                {{Form::open(['url'=>route('email.store'), 'method'=>'POST', 'class'=>'form'])}}
                    <div class="row ml-3">
                        <div class="p-2 form-group col-md-3">
                            {{Form::radio('action','all',true,['id'=>'allStudent', 'class'=>'form-check-input'])}}
                            <label for="allStudent">All Student</label>
                        </div>
                        <div class="p-2 form-group col-md-3">
                            {{Form::radio('action','score',false,['id'=>'scoreStudent', 'class'=>'form-check-input'])}}
                            <label for="scoreStudent">Score < 5</label>
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::text('title',null,['class'=>'form-control','placeholder'=>'Title'])}}
                    </div>
                    <div class="form-group">
                        {{Form::textarea('content',null,['placeholder'=>'Content' , 'class'=>'form-control'])}}
                    </div>
                    {{Form::submit('Send',['class'=>'btn btn-primary'])}}
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
