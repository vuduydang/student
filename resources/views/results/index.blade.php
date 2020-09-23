@extends('layouts.index')
@section('content')
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {!! Session::get('success') !!}
            </div>
        @endif
        <h1 class="mt-4">Student Subjects Update</h1>
        <div class="nav" id="student" data-id="{{ $student->id }}" data-course="{{ $student->course->id }}">
            <span class="nav-item mr-2">Name: <p class="d-inline text-info">{{ $student->name }}</p></span>
            <span class="nav-item mr-2">Course: <p class="d-inline text-info">{{ $student->course->name }}</p></span>
        </div>
        <button onclick="document.querySelector('#formUpdateSubject').submit()" class="btn btn-info">Update</button>
        <div class="row">
            <div class="col-xl-5 border rounded m-2">
                <div class="table-responsive">
                    {{ Form::open(['method'=>'PUT','url'=>route('results.updateForStudent'),'id'=>'formUpdateSubject']) }}
                    {{ Form::hidden('course', $student->course->id) }}
                    <h5 class="text-secondary p-2">Subjects for Student</h5>
                    <table class="table table-bordered">
                        <thead id="table" data-url="/results">
                        <tr>
                            <th>Status</th>
                            <th>Name</th>
                        </tr>
                        </thead>
                        <tbody class="table-subject-student">
                            @foreach($results as $result)
                                <tr>
                                    <td class="text-info">&diams;</td>
                                    <td>
                                        {{$result->name}}
                                        <input type="hidden" name="subject[]" value="{{ $result->id }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{Form::close()}}
                </div>
            </div>
            <div class="col-xl-5 border rounded m-2">
                <div class="table-responsive">
                    <h5 class="text-secondary p-2">Subjects </h5>
                    <table class="table table-bordered">
                        <thead id="table" data-url="/results">
                        <tr>
                            <th>Status</th>
                            <th>Name</th>
                        </tr>
                        </thead>
                        <tbody class="table-subjects">
                            @foreach($subjects as $subject)
                                <tr class="create-subject" data-id="{{$subject->id}}" data-subject="{{$subject->name}}">
                                    <td class="text-danger">&diams;</td>
                                    <td>
                                        {{$subject->name}}
                                        <input type="hidden" name="subject[]" value="{{ $subject->id }}">
                                        <a class="btn float-right text-info">
                                            <i class="fab fa-get-pocket"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
