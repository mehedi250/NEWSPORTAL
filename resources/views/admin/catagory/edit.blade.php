@extends('admin.layouts.app')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">News Catagory</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Catagory</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
@section('content')
<div class="card card-teal">
    <div class="card-header">
        <h3 class="card-title">Catagory Update Form</h3>
    </div>
    <!-- /.card-header -->

    <!-- form start -->
    <form  method="POST" action="{{route('catagories.update',$catagory->id)}}" class="form-horizontal" enctype="multipart/form-data" >
        @method('PUT')
        @csrf
        <div class="card-body">
            <div class="row col-md-12">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger position-relative">*</span></label>
                        <input value="{{$catagory->name}}" class="form-control" type="text" name="name" placeholder="Name" id="name" required>
                        @error('name') 
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="{{route('catagories.index')}}" class="btn btn-default">Cancel</a>
            <button type="submit" id="" class="btn btn-primary float-right">Submit</button>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
@endsection

