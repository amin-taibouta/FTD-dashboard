<?php

namespace App\Http\Controllers;

use App\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class CallsReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        return view('calls-report', compact('widget'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function callsDatatables()
    {
		$result = DB::select( DB::raw("SET NOCOUNT ON; exec dbo.DTP_CallsList  @start = '2022-07-06', @end = '2022-07-18' "));
		return Datatables::of($result)->make(true);
    }
}
