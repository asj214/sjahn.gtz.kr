<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //
    use SoftDeletes;

    protected $table = "posts";
    protected $dates = ['deleted_at'];
    protected $with = ['user'];

    protected $fillable = [
        'category_id', 'user_id', 'title', 'body'
    ];

    public function attachments(){
        return $this->hasMany(Attachment::class, 'attachment_id')->where('attachment_type', 'posts')->orderBy('id', 'asc');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
