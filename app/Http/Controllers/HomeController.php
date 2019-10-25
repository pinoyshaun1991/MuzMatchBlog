<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ajaxRequest()
    {
        return view('blogetc_admin::layouts.sidebar');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ajaxRequestPost(Request $request)
    {
        $input = $request->all();
        $type  = $input['stack_type'] == 0 ? 'PHP' : 'Node';

        DB::table('stack')->insert(
            ['stack_type' => $input['stack_type']]
        );

        return response()->json(['success'=> 'Switched to the '.$type.' stack']);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ajaxRequestJson()
    {
        return view('blogetc_admin::layouts.sidebar');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ajaxRequestPostJson(Request $request)
    {
        if (file_exists(__DIR__.'/../../../public/resultsPost.json')) {
            unlink(__DIR__ . '/../../../public/resultsPost.json');
        }

        $input = $request->all();

        $fp = fopen('resultsPost.json', 'w');
        fwrite($fp, $input['json']);
        fclose($fp);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ajaxRequestCommentJson(Request $request)
    {
        if (file_exists(__DIR__.'/../../../public/results.json')) {
            unlink(__DIR__ . '/../../../public/results.json');
        }

        $input = $request->all();

        $fp = fopen('results.json', 'w');
        fwrite($fp, $input['json']);
        fclose($fp);
    }
}
