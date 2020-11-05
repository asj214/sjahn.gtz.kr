<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Banner extends Model {
    //
    use SoftDeletes;

    protected $table = "banners";
    protected $dates = ['deleted_at'];
    protected $with = ['user', 'attachment'];

    protected $fillable = [
        'category_id', 'user_id', 'title', 'body', 'link'
    ];

    public function attachment(){
        return $this->hasOne(Attachment::class, 'attachment_id')->where('attachment_type', 'banners')->orderBy('id', 'desc');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}
