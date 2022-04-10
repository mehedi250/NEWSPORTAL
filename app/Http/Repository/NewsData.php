<?php

namespace App\Http\Repository;
use App\Models\News;

class NewsData
{
    public function index()
    {
        $news = News::all();
        return $news;
    }

    public function findNews($id)
    {
        $news = News::find($id);
        return $news;
    }
    public function newsFinal($paginate)
    {
        $news = News::take($paginate)->orderBy('date', 'desc')->get();
        return $news;
    }
    public function basicSearch($search)
    {
        $news = News::where('title', 'like', '%' . $search . '%')->get();
        return $news;
    }

    public function finalSearchData($search, $paginate, $page)
    {
        $news = News::where('title', 'like', '%' . $search . '%')->orderBy('date', 'desc')->skip($paginate * $page)->take($paginate)->get();
        return $news;
    }

    public function catagoryNews($id)
    {
        $news = News::where('catagory_id', $id)->orderBy('date', 'desc')->get();;
        return $news;
    }
}