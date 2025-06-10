<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tour;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;

class UsersController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except(['show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $users = User::where('email', 'like', "%{$query}%")
                ->orWhere('name', 'like', "%{$query}%")
                ->get();
        } else {
            $users = User::all();
        }
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $query = $request->input('query');

        $tourQuery = Tour::where('user_id', $user->id);

        if ($query) {
            $tourQuery->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('company_name', 'like', "%{$query}%");
            });
        }

        $tours = $tourQuery->get();

        return view('user.show', compact('user', 'tours'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = UserRole::all();

        return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'role_id' => 'required|exists:user_roles,id',
            'locale' => 'nullable|in:en,lv',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'required|min:6|confirmed';
        }


        $validated = $request->validate($rules);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role_id = $validated['role_id'];
        $user->locale = $validated['locale'] ?? 'lv';

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('user.show', $user)->with('success', 'Lietotāja profils atjaunināts veiksmīgi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $tours = Tour::where('user_id', $user->id)->get();
        foreach ($tours as $tour) {
            $tour->user_id = Auth::id();
            $tour->save();
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Lietotājs dzēsts veiksmīgi.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $users = User::where('email', 'like', "%{$query}%")
            ->orWhere('name', 'like', "%{$query}%")
            ->select('id', 'name', 'email')
            ->limit(5)
            ->get();

        return response()->json($users);
    }
}
