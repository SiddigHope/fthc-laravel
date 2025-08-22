<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switchLocale($locale)
    {
        if (!in_array($locale, ['en', 'ar'])) {
            abort(400);
        }

        session()->put('locale', $locale);
        app()->setLocale($locale);

        return redirect()->back();
    }
}
