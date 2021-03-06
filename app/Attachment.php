<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Attachment extends Model
{
    //
    use SoftDeletes;

    protected $table = "attachments";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'attachment_id', 'attachment_type', 'user_id', 'filename', 'url'
    ];


}
