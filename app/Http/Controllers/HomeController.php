<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
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
            $user = User::select('id','name','email','created_at','updated_at')->get();
            return Datatables::of($user)->addIndexColumn()
                ->addColumn('created_at', function ($user) {
                    return Carbon::parse($user->created_at);
                })
                ->addColumn('updated_at', function ($user) {
                    return Carbon::parse($user->updated_at)->diffForHumans();
                })
                ->addColumn('action', function($row){
                    $btn = '<div class="flex justify-content-center">
                                <a href="/user/edit/'.$row->id.'" class="btn btn-primary btn-sm">Edit</a>
                                <a href="/user/subscribe/'.$row->id.'" class="btn btn-secondary mx-2 btn-sm">Subscribe</a>
                                <button class="btn btn-danger btn-sm btn_delete" data-id="'.$row->id.'">Delete</button>
                             </div>';
                    return $btn;
                })
                ->rawColumns(['created_at', 'updated_at', 'action'])
                ->make(true);

        }

        return view('home');
    }

    public function create(User $user)
    {
        return view('create');
    }

    public function store(User $user)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('users', 'email')],
            'password' => 'required|min:8|max:255',
        ]);
        $attributes['password'] = Hash::make($attributes['password']);
        User::create($attributes);

        return redirect('/home')->with('success', 'User Created!');
    }

    public function edit(User $user)
    {
        return view('edit', ['user' => $user]);
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'required|min:8|max:255',
        ]);
        $attributes['password'] = Hash::make($attributes['password']);
        $user->update($attributes);

        return back()->with('success', 'User Updated!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Post Deleted!');
    }
}
