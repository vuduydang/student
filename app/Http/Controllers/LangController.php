<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    private $langActive = [
        'vi',
        'en'
    ];
    public function changeLang($lang)
    {
        if (in_array($lang, $this->langActive)) {
            session()->put('lang',$lang);
        }
        return redirect()->back();
    }
}
