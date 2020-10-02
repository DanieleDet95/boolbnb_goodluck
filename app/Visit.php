<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
  protected $fillable = [
    "id",
    "data",
    "suite_id",
  ];

  public function suite() {
    return $this->belongsTo("App\Suite");
  }
}
