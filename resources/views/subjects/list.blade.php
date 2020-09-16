@extends('layouts.index')
@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {!! Session::get('success') !!}
        </div>
    @endif
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Subjects List</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('dash') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">{{$course->name}}</a></li>
                <li class="breadcrumb-item active">Subjects List</li>
            </ol>
            <div class="card mb-4">
                <div class="nav-item col-md-2">
                    <a href="#" class="btn btn-info"
                       data-id="{{$course->id}}"
                       data-toggle="modal"
                       data-target="#modalAdd">Add Subject</a>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header btn" data-toggle="collapse" data-target="#subject-">
                    <i class="fas fa-table mr-1"></i>
                    DataTable Courses
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead id="table" data-url="/subjects" >
                            <tr>
                                <th>STT</th>
                                <th>Name</th>
                                <th width="200">Option</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Name</th>
                                <th>Option</th>
                            </tr>
                            </tfoot>
                            <tbody id="table-body">
                            @foreach($subjects as $index => $sub)
                                <tr id="row-{{ $sub->id }}">
                                    <td>{{$index+1}}</td>
                                    <td class="name-{{$sub->id}}">{{ $sub->name }}</td>
                                    <td>
                                        <button type="button"
                                                class="btn btn-primary btnUpdate"
                                                data-id="{{$sub->id}}"
                                                data-value="{{$sub->name}}"
                                                data-toggle="modal"
                                                data-target="#exampleModal">
                                            Rename
                                        </button>
                                        <button onclick="remove({{ $sub->id }})" class="btn btn-danger">Del</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal rename-->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Courses</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="name" class="form-control" id="inputUpdateName">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="update">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End modal -->
                    <!-- Modal Add subject-->
                    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Subject <span class="text-info">{{$course->name}}</span></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @csrf
                                    <input type="text" name="name" class="form-control" id="inputAddName">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="handelAdd({{$course->id}})">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End modal -->
                </div>
            </div>
        </div>
    </main>
@endsection
