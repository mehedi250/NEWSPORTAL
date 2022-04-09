<?php

namespace App\Http\Repository;
use App\Models\Catagory;

class CatagoryData
{
    public function index()
    {
        $catagories = Catagory::all();
        return $catagories;
    }
}