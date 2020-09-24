@extends('layouts/index')
@section('content')
{{--    {{dd(old())}}--}}
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {!! Session::get('success') !!}
            </div>
        @endif
        <h1 class="mt-4">Student Subjects Update</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dash') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('students.index') }}">Students List</a></li>
            <li class="breadcrumb-item active">Student Subjects Update</li>
        </ol>
        <div class="nav" id="student" data-id="{{ $student->id }}" data-course="{{ $student->course->id }}">
            <span class="nav-item mr-2">Name: <p class="d-inline text-info">{{ $student->name }}</p></span>
            <span class="nav-item mr-2">Course: <p class="d-inline text-info">{{ $student->course->name }}</p></span>
        </div>
        <div class="card">
            <div class="card-header">
                Update Student Subjects
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {{Form::open(array('url'=>route('results.update',$student)))}}
                        {{ Form::hidden('course', $student->course->id) }}
                    <button name="_method" value="PUT" class="btn btn-info">Update</button>
                    <table class="table table-bordered">
                        <thead id="table" data-url="/results">
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th width="200">Score</th>
                        </tr>
                        </thead>
                        <tfoot id="create-column" class="d-none">
                            <tr class="create-column" style="cursor: pointer">
                                <td colspan="3" class="text-center bg-light">
                                    <span class="text-muted">+ Create Column</span>
                                </td>
                            </tr>
                        </tfoot>
                        <tbody class="results">
                        @if(!old())
                            @foreach($student->results as $index => $subjectResults)
                                <tr id="row-{{ $subjectResults->pivot->id }}" data-id="{{$subjectResults->pivot->id}}" class="result-update row-input" >
                                    <td name="stt">
                                        {{ $index+1 }}
                                    </td>
                                    <td>
                                        <label>{{ $subjectResults->name }}</label>
                                        <input type="hidden" name="subject[]" class="subjects-{{$index}}" value="{{ $subjectResults->id }}">
                                    </td>
                                    <td name="result">
                                        <input type="text" name="score[]" value="{{$subjectResults->pivot->score}}" class="form-control d-inline-block col-md-8"/>
                                        <span class="btn text-danger" onclick="remove({{$subjectResults->pivot->id}})" ><i class="fas fa-trash-alt"></i></span>
                                        @error('score.'.$index)
                                        <span class="invalid-feedback d-block" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                        @enderror
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @foreach($student->results as $index => $subjectResults)
                                <tr id="row-{{ $subjectResults->pivot->id }}" data-id="{{$subjectResults->pivot->id}}" class="result-update row-input" >
                                    <td name="stt">
                                        {{ $index+1 }}
                                    </td>
                                    <td>
                                        <label>{{ $subjectResults->name }}</label>
                                        <input type="hidden" name="subject[]" class="subjects-{{$index}}" value="{{ $subjectResults->id }}">
                                    </td>
                                    <td name="result">
                                        <input type="text" name="score[]" value="{{$subjectResults->pivot->score}}" class="form-control d-inline-block col-md-8"/>
                                        <span class="btn text-danger" onclick="remove({{$subjectResults->pivot->id}})" ><i class="fas fa-trash-alt"></i></span>
                                        @error('score.'.$index)
                                        <span class="invalid-feedback d-block" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                        @enderror
                                    </td>
                            @endforeach
                            @foreach($subjects as $subject)
                                @if(in_array($subject->id,old('subject')))
                                <tr id="row-0{{array_search($subject->id, old('subject'))}}" class="result-update row-input">
                                    <td name="stt">{{array_search($subject->id, old('subject'))+1}}</td>
                                    <td>
                                                <label>{{ $subject['name'] }}</label>
                                        <input type="hidden" name="subject[]" value="{{ $subject->id }}">
                                    </td>
                                    <td name="result">
                                        <input type="text" name="score[]" value="{{ old('score')[array_search($subject->id, old('subject'))] }}" class="form-control d-inline-block col-md-8"/>
                                        <span class="btn text-danger" onclick="removeColumn({{array_search($subject->id, old('subject'))}})" ><i class="fas fa-trash-alt"></i></span>
                                        @error('score.'.array_search($subject->id, old('subject')))
                                        <span class="invalid-feedback d-block" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                        @enderror
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection
