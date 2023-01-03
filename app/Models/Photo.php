<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'blog_photo_list';

    protected $primaryKey = 'photo_id';

    protected $fillable = [
        'album_id',
        'img_url',
        'img_name'
    ];

    public function album()
    {
        return $this->belongsTo('App\Models\BlogNavPhoto','id','photo_id');
    }
}
