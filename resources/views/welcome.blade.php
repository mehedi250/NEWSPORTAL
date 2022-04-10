<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{asset('assets/images/logo.png')}}">

        <title>NEWSPORTAL</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .image-box{
                position: relative;
                height: 200px;
                overflow: hidden;
                border-radius: 5px 5px 0px 0px;
            }
            .search, .form-control{
                max-width: 180px!important;
            }
        </style>
    </head>
    <body class="">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('site.index')}}">NEWSPORTAL</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('site.index')}}">Home</a>
                        </li>
                        
                        @if (Route::has('login'))
                
                        @auth
                        <li class="nav-item">
                
                            <a href="{{ route('admin.dashboard') }}" class="nav-link" >Dashboard</a>
                        </li>
                        
                        @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Log in</a>
                        </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">Register</a>
                            </li>
                            @endif
                        @endauth
                
                        @endif
                    </ul>

                    <input class="form-control me-2 shadow-none" id="search" name="search" value=""  placeholder="Search"  onkeydown="loadSearchData()">
                    {{-- <button class="btn btn-outline-success shadow-none"  id="search-btn" type="submit" onClick="searching();">Search</button> --}}

                </div>
            </div>
        </nav>
        <div class="container">
            <div class="catagory pt-4">
                <a href="{{route('site.index')}}" class="btn btn-info px-3 ">All</a>
                @foreach($catagories as $catagory)
                    <a href="{{route('news.catagory',$catagory->id)}}" class="btn btn-info px-3">{{$catagory->name}}</a>
                @endforeach
            </div>

            <div class="row" id="fetchItem">
                @include('layouts.news_render')
            </div>
                
            <div class="text-center py-4" id="paginationSection">
                @include('layouts.pagination')
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>
            var page = 0;
            var totalPage = {{$totalPage}};
            var search = "";
            disableButton();
            var timeout = null;

            // function searching(){
            //     page = 0;
            //     search = document.getElementById('search').value;
            //     fetchFunction(0);
            // }
            
            function fetchFunction(p){
                if( p == 'p'){
                    page = page - 1;
                    if(page<0){
                        page = 0;
                        return;
                    }
                }
                else if( p == 'n'){
                    page = page + 1;
                    let max = totalPage-1;
                    if(page>max){
                        page = max;
                        return;
                    }
                }
                else{
                    page = p;
                }

                fetch('{{route('site.fetch')}}?page='+page+'&search='+search)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('fetchItem').innerHTML=data.html;
                    document.getElementById('paginationSection').innerHTML=data.pagination;
                    totalPage = data.totalPage;
                    disableButton()
                })
                .catch(function(error) {
                    console.log(error);
                }); 
            }

            function disableButton(){
                if(page == 0) {
                    document.getElementById("pageBtnPrevious").disabled = true;
                }
                if(page == totalPage-1){
                    document.getElementById("pageBtnNext").disabled = true;
                }
                document.getElementById("pageBtn"+page).disabled = true;
            }

            function loadSearchData(){
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                    page = 0;
                    search = document.getElementById('search').value;
                    fetchFunction(0);
                    clearTimeout(timeout)
                }, 700);
            }
     
  
        </script>
    
    </body>
</html>
