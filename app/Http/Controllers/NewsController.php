<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Catagory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['news'] = News::all();
        return view('admin.news.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['catagories'] = Catagory::all();
        return view('admin.news.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'bail|required|max:200',
            'date' => 'bail|required',
            'content' => 'bail|required',
            'catagory_id' => 'bail|required',
            'image' =>  'bail|required|mimes:jpg,jpeg,png,gif',
        ];

        $request->validate($rules);

        $postData = $request->only(['title', 'date', 'content', 'catagory_id']);

        if ($request->hasFile('image')) {
            $filename = imageName($request->image->getClientOriginalName(), 1, 'image');
            $postData['image'] = $request->file('image')->storeAs('assets/images', $filename);
        }

        $postData['user_id'] = auth()->id();
        $news = News::create($postData);

        return redirect()->route('news.index')->with('success','Data Added Successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $catagories = Catagory::all();
        return view('admin.news.edit', compact('news', 'catagories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $rules = [
            'title' => 'bail|required|max:200',
            'date' => 'bail|required',
            'content' => 'bail|required',
            'catagory_id' => 'bail|required',
            'image' =>  'bail|mimes:jpg,jpeg,png,gif',
        ];

        $request->validate($rules);

        $postData = $request->only(['title', 'date', 'content', 'catagory_id']);

        if ($request->hasFile('image')) {
            unlinkFile($news->image);
            $filename = imageName($request->image->getClientOriginalName(), 1, 'image');
            $postData['image'] = $request->file('image')->storeAs('assets/images', $filename);
        }

        $news->update($postData);

        return redirect()->route('news.index')->with('success','Data Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index')->with('success','Data Deleted Successfully!');
    }
}
