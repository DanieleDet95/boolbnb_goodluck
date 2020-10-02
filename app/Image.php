<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Image extends Model
{
    protected $fillable = [
      "suite_id",
      "path",
    ];

    public function suite() {
      return $this->belongsTo("App\Suite");
    }
}
