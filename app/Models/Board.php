<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Board extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'media',
    ];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->belongsToMany(User::class,'board_like',)->withTimestamps();
    }

    public function getMediaURL(){
        if($this->media){
            return url('storage/'.$this->media);
        }
        return "https://pbs.twimg.com/media/FeG09JKUcAAG2dD.png";
    }

}
