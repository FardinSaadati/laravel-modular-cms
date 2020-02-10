<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Page extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'pages';

    protected $fillable = [
        'title', 'slug' , 'body' , 'p_body' , 'is_published' , 'views'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }


}
