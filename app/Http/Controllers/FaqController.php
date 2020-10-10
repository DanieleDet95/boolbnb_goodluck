<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;


class FaqController extends Controller
{
    public function index() {
      $faqs = Faq::all();

      return view('guest.faq', compact('faqs'));
    }
}
