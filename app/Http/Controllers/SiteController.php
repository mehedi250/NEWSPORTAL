<?php

namespace App\Http\Controllers;
use App\Models\News;
use App\Models\Catagory;
use App\Models\Comment;
use Illuminate\Http\Request;

use App\Http\Repository\Service;

class SiteController extends Controller
{
    public function index(Request $request)
    {

        $paginate = 3;
        $data['catagories'] = Catagory::all();
        $search = "";
    
        if(isset($request->search)){
            $search = $request->search;
        }
      
        $news = News::where('title', 'like', '%' . $search . '%')->get();
        $data['news'] = News::where('title', 'like', '%' . $search . '%')->take($paginate)->orderBy('date', 'desc')->get();
        $data['count'] = $news->count();
        $data['totalPage'] = ceil($data['count'] / $paginate);

        return view('welcome', $data);
    }
    public function fetch(Request $request)
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
        $news = News::where('title', 'like', '%' . $search . '%')->get();
        $data['count'] = $news->count();

        $data['lastPage'] = ceil($data['count'] / $paginate);

        $data['news'] = News::where('title', 'like', '%' . $search . '%')->orderBy('date', 'desc')->skip($paginate * $page)->take($paginate)->get();

        $data['html'] = view('layouts.news_render', $data)->render();


    
        return response()->json($data);
        
        
    }

    public function news($id)
    {
        $data['news'] = News::find($id);
        return view('news', $data);
    }
    public function catagoryNews($id)
    {
        $data['catagories'] = Catagory::all();
        $data['newsCatagory'] = Catagory::find($id);
        $data['news'] = News::where('catagory_id', $id)->orderBy('date', 'desc')->get();
        return view('catagory_news', $data);
    }
    public function comment(Request $request, $id)
    {
        $rules = [
            'comment' => 'bail|required',

        ];

        $request->validate($rules);

        $postData = $request->only(['comment']);

        $postData['user_id'] = auth()->id();
        $postData['news_id'] = $id;

        $comment = Comment::create($postData);

        return redirect()->route('news.view', $id);
       
        
    }
}
