<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    
    public function language($language)
    {
        \Session::put('locale', $language);        
        return \Redirect::back();
    }    
}
