<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
      'supplements',
    ];

    public function suites() {
      return $this->belongsToMany("App\Suite");
    }
}
