<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\RedirectResponse;


class SetLocaleController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        App::setlocale(strval($request->string('locale')));
        $request->session()->put('locale', strval($request->string('locale')));

        return back();
    }
}
