<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    protected $fillable = [
      "start",
      "end",
      "type",
      "price",
    ];

    public function suites() {
      return $this->belongsToMany("App\Suite")->withPivot('start')->withPivot('end');
    }

}
