<?php

namespace App\Http\Repository;
use App\Models\Catagory;

class CatagoryData
{
    public function index()
    {
        return  Catagory::get();
    }

    public function find($id)
    {
        return  Catagory::find($id);
    }
}