<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $fillable = [
    "email",
    "body",
    "name",
    "suite_id",
  ];

  public function suite() {
    return $this->belongsTo("App\Suite");
  }
}
