<?php

namespace App\Http\Service;
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

        $commentData = new CommentData();
        $commentData->store($postData);
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

    public function findNews($id)
    {
        $newsData = new NewsData();
        $news = $newsData->findNews($id);
        return $news;
    }

    public function catagoryNews($id){
        $catagoryData = new CatagoryData();
        $newsData = new NewsData();

        $data['catagories'] = $catagoryData->index();
        $data['newsCatagory'] = $catagoryData->find($id);
        $data['news'] = $newsData->catagoryNews($id);

        return $data;
    }

}
