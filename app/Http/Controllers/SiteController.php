<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Service\Service;

class SiteController extends Controller
{
    public function index()
    {
        $serv = new Service();
        $data = $serv->indexNews();
        return view('welcome', $data);
    }
    public function fetch(Request $request)
    {
        $serv = new Service();
        $data = $serv->fetchNews($request);
        return response()->json($data);
    }
    public function news($id)
    {
        $serv = new Service();
        $data['news'] = $serv->findNews($id);
        return view('news', $data);
    }
    public function catagoryNews($id)
    {
        $serv = new Service();
        $data = $serv->catagoryNews($id);
        return view('catagory_news', $data);
    }
    public function comment(Request $request, $id)
    {
        if (Auth::check()) {
            $serv = new Service();
            $serv->storeComment($request, $id);
            return redirect()->route('news.view', $id);
        }
        else abort(404);
    }
}
