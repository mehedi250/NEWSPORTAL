<?php

namespace App\Http\Repository;
use App\Models\News;
use App\Models\Catagory;
use App\Models\Comment;


class Service
{
  
    public function fetch($paginate, $page, $search)
    {

        $news = News::where('title', 'like', '%' . $search . '%')->orderBy('date', 'desc')->skip($paginate * $page)->take($paginate)->get();
        $html = view('layouts.news_render', $news)->render();

        return response()->json($html);
    }

}
