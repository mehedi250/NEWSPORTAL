@extends('admin.layouts.app')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">News</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">News</li>
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
                            <h3 class="card-title">News</h3>
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-primary btn-xs float-right pl-3 pr-3" href="{{route('news.create')}}"> Add</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="pageDatatable" class="table table-striped" style="width:100%;">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Catagory</th>
                                <th>Date</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($news as $post)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->catagory->name }}</td>
                                <td>{{ $post->date }}</td>

                                
                                <td>
                                <a href="{{route('news.edit',$post->id)}}" class="btn btn-sm btn-primary text-white text-center"><i class="far fa-edit"></i></a>
                                <form style="display:inline;" method="POST" action="{{route('news.destroy',$post->id)}}">
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