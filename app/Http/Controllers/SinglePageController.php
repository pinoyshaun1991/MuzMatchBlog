<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use WebDevEtc\BlogEtc\Controllers\BlogEtcAdminController;

class SinglePageController extends Controller
{
    public function index() {

        if (Auth::check()) {
            $blogController = new BlogEtcAdminController();
            return $blogController->index();
        } else {
            return view('app');
        }
    }
}
