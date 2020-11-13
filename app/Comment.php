<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    //
    use SoftDeletes;

    protected $table = "comments";
    protected $dates = ['deleted_at'];
    protected $with = ['user'];

    protected $fillable = [
        'commentable_id', 'commentable_type', 'user_id', 'body'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
