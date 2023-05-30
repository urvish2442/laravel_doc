<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserSubscriptionController extends Controller
{
    public function create(User $user)
    {
        return view('subscribe', ['user' => $user]);
    }
    public function store(User $user)
    {
        $attributes = request()->validate([
            'user_id' => 'required',
            'end_date' => 'required',
        ]);
        $attributes['start_date'] = Carbon::now();
        $attributes['end_date'] = Carbon::now()->addDays($attributes['end_date']);
        Subscription::create($attributes);


        return redirect('/home')->with('success', 'Subscription Successful!');
    }
}
