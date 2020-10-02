<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suite extends Model
{
    protected $fillable = [
      'user_id',
      'title',
      'address',
      'rooms',
      'beds',
      'baths',
      'square_m',
      'latitude',
      'longitude',
      'price',
      'description',
      'main_image',
    ];

    public function user() {
      return $this->belongsTo('App\User');
    }

    public function highlights() {
      return $this->belongsToMany('App\Highlight')->withPivot('start')->withPivot('end');
    }

    public function images() {
      return $this->hasMany('App\Image');
    }

    public function messages() {
      return $this->hasMany('App\Message');
    }

    public function visits() {
      return $this->hasMany('App\Visit');
    }

    public function services() {
      return $this->belongsToMany("App\Service");
    }

}
