@extends('admin.layouts.app')

@section('content-header')
 
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">News Catagory</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Catagory</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ $message }}</strong>
    </div>
    @endif
    @if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ $message }}</strong>
    </div>
    @endif

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="card-title">News Catagory</h3>
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-primary btn-xs float-right pl-3 pr-3" href="{{route('catagories.create')}}"> Add</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="pageDatatable" class="table table-striped" style="width:100%;">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($catagories as $catagory)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $catagory->name }}</td>
                               
                                <td>
                                <a href="{{route('catagories.edit',$catagory->id)}}" class="btn btn-sm btn-primary text-white text-center"><i class="far fa-edit"></i></a>
                                <form style="display:inline;" method="POST" action="{{route('catagories.destroy',$catagory->id)}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a href="" class="deletePresident btn btn-sm btn-danger text-white text-center"  ><i class="fa-times fas"></i></a>    
                                </form>
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
@push('script')
  
    <script type="text/javascript">
        $(document).ready(function () {
            $('#pageDatatable').DataTable();
            $('.deletePresident').click(function(e){
                e.preventDefault();
                if(confirm("Do you want to delete this item?")){
                   $(this).closest('form').submit(); 
                }
            });
        });
    </script>
    
@endpush
