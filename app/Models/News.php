<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $fillable = [
        'id',
        'title',
        'date',
        'content',
        'image',
        'catagory_id',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function catagory(){
        return $this->belongsTo(Catagory::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }

}
