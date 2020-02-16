<?php

namespace Modules\Khadamat;


use Illuminate\Database\Eloquent\Model;

class Images extends Model {

	protected $table = 'service_images';
	public $timestamps = true;

    protected $fillable = [
	    'img',
        'size'
    ];

    protected $appends = ['full_url_image'];

    public function getFullUrlImageAttribute()
    {
        return asset('uploads/admins/general-images/'.$this->img);
    }


}