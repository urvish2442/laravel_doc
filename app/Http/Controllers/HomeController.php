<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('id','name','email')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<div class="flex justify-content-center"><a href="#" class="btn btn-primary btn-sm">Edit</a><a href="#" class="btn btn-warning mx-2 btn-sm">Delete</a></div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('home');
    }
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'Post Deleted!');
    }
}
