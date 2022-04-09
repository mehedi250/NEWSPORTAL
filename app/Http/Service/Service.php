<?php

namespace App\Http\Service;

use App\Models\Catagory;
use App\Models\Comment;
use App\Models\News;

use App\Http\Repository\NewsData;
use App\Http\Repository\CatagoryData;
use App\Http\Repository\CommentData;
class Service
{
    public function fetchNews($request)
    {
        $paginate = 3;
        $page = 0;
        $search="";
        if(isset($request->page)){
            $page = $request->page;
        }
        if(isset($request->search)){
            $search = $request->search;
        }

        $newsData = new NewsData();
        $news = $newsData->basicSearch($search);
        $data['count'] = $news->count();
        $data['lastPage'] = ceil($data['count'] / $paginate);
        $data['news'] = $newsData->finalSearchData($search, $paginate, $page);
        $data['html'] = view('layouts.news_render', $data)->render();
        $data['totalPage'] = ceil($data['count'] / $paginate);
        $data['pagination'] = view('layouts.pagination', $data)->render();

        return $data;
    }

    public function storeComment($request, $id)
    {
        $rules = [
            'comment' => 'bail|required',
        ];

        $request->validate($rules);
        $postData = $request->only(['comment']);
        $postData['user_id'] = auth()->id();
        $postData['news_id'] = $id;
        $comment = Comment::create($postData);
    }

    public function indexNews()
    {
        $catagoryData = new CatagoryData();
        $newsData = new NewsData();

        $paginate = 3;
        $news = $newsData->index();
        $data['catagories'] = $catagoryData->index();
        $data['news'] = $newsData->newsFinal($paginate);
        $data['count'] = $news->count();
        $data['totalPage'] = ceil($data['count'] / $paginate);

        return $data;
    }

    public function catagoryNews($id){
        $data['catagories'] = Catagory::all();
        $data['newsCatagory'] = Catagory::find($id);
        $data['news'] = News::where('catagory_id', $id)->orderBy('date', 'desc')->get();
        return $data;
    }

}
