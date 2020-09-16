@extends('layouts.index')
@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Courses Update</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dash') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('courses.list') }}">Courses List</a></li>
            <li class="breadcrumb-item active">Courses Update</li>
        </ol>
        <div class="card">
            <div class="card-header">
                <i class="fab fa-wpforms"></i>
                Form Update Courses
            </div>
            <div class="card-body">
                <form action="" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNam4">Name</label>
                            <input type="text" name="name" class="form-control" id="inputName4" placeholder="Name">
                            @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
