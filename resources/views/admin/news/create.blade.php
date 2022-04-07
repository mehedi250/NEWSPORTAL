@extends('admin.layouts.app')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">News</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">News</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
@section('content')
<style>
    #blah{
        height: 50px;
        width: auto;
    }
</style>
<div class="card card-teal">
    <div class="card-header">
        <h3 class="card-title">News Add Form</h3>
    </div>
    <!-- /.card-header -->

    <!-- form start -->
    <form  method="POST" action="{{route('news.store')}}" class="form-horizontal" enctype="multipart/form-data" >
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger position-relative">*</span></label>
                        <input class="form-control" type="text" name="title" placeholder="Title" id="title" required>
                        @error('title') 
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
           

                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="catagory_id">Catagory <span class="text-danger position-relative">*</span></label>
                        <select class="custom-select form-control-border" id="catagory_id" name="catagory_id">
                          <option value=""  disabled selected>Select Catagory</option>
                          @foreach ($catagories as $catagory)
                             <option value="{{$catagory->id}}">{{$catagory->name}}</option> 
                          @endforeach
                        </select>
                        @error('catagory_id') 
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="exampleInputFile">Image <span class="text-danger position-relative">*</span></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="file-input w-100" id="exampleInputFile" name="image" onchange="readURL(this);">
                            <label class="custom-file-label" for="exampleInputFile">Choose Image</label>
                          </div>
                        </div>
                        <img id="blah" src="#" alt="" />
                        @error('image') 
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="date">Date <span class="text-danger position-relative">*</span></label>
                        <input class="form-control" type="date" name="date" placeholder="Date" id="date" required>
                        @error('date') 
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="content">Content <span class="text-danger position-relative">*</span></label>
                       <textarea id="summernote" name="content"  placeholder="Enter News Content" required>  </textarea>
                        @error('content') 
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
               
               
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="{{route('news.index')}}" class="btn btn-default">Cancel</a>
            <button type="submit" id="" class="btn btn-primary float-right">Submit</button>
        </div>
        <!-- /.card-footer -->
    </form>
</div>


@endsection

@push('script')

    <script>
        $(function () {
            $('#summernote').summernote({
                height: 300     
            });
        });
        $(function () {
            bsCustomFileInput.init();
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
                    
    </script>
@endpush
