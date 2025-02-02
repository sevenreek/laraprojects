<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        $langs = config('languages');
        if (array_key_exists($lang, $langs)) {
            Session::put('applocale', $lang);
        }
        return Redirect::back();
    }
}