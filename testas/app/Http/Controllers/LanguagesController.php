<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    public function language($language)
    {
        \Session::put('language', $language);

        return redirect()->back();
    }
}
