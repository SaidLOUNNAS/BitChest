<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        if (Str::contains($request->path(), 'profile')) {
            view()->composer('layouts.layout', function ($view) {
                $view->with('section', 'profile');
            });
        } else {
            view()->composer('layouts.layout', function ($view) {
                $view->with('section', 'users');
            });
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all users not logged in
        $users = User::all()->except(Auth::id());

        // Format subscription date
        $users = $users->map(function ($user) {
            $carbon_date = new Carbon($user->created_at);
            $user->subscription_date = $carbon_date->format('d/m/Y h:m');
            return $user;
        });

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // Check if email hasn't already been taken
            'email'     => 'unique:App\Models\User,email',
            // Check if password  confirmed
            'password'  => 'confirmed'
        ]);

        $attributes = $request->all();
        $attributes['password'] = Hash::make($request->password);
      // Create the user in database
        User::create($attributes);

        return redirect()
            ->route('users.index')
            ->with('message', "The user has been successfully created.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Show the form for editing the logged user's profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            // Check if email hasn't already been taken
            'email' => 'unique:App\Models\User,email,' . $user->id . ',id'
        ]);
        // Update the user
        $user->update($request->all());

        return redirect()
            ->route('users.index')
            ->with('message', "The user has been changed successfully.");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, User $user)
    {
        $request->validate([
            'email' => 'unique:App\Models\User,email,' . $user->id . ',id'
        ]);
        // update user
        $user->update($request->all());

        return redirect()
            ->route('home')
            ->with('message', "Your personal information has been modified.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('message', "The user has been deleted.");
    }
}
