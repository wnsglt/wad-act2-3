<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of customer profiles.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $profiles = Profile::with('user', 'orders')->oldest()->get();
        } else {
            $profiles = Profile::with('user', 'orders')
                ->where('user_id', $user->id)
                ->get();
        }

        return view('customers.index', compact('profiles'));
    }

    /**
     * Show the form for creating a customer profile.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created customer profile.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
        ]);

        Auth::user()->profiles()->create([
            'name'    => $request->name,
            'email'   => $request->email,
            'address' => $request->address,
            'phone'   => $request->phone,
        ]);

        return redirect()->route('customers.index')
            ->with('success', 'Customer profile created successfully!');
    }

    /**
     * Display the specified customer profile.
     */
    public function show(string $id)
    {
        $profile = Profile::with('user', 'orders.products')->findOrFail($id);

        if (!Auth::user()->isAdmin() && $profile->user_id !== Auth::id()) {
            abort(403);
        }

        return view('customers.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified profile.
     */
    public function edit(string $id)
    {
        $profile = Profile::findOrFail($id);

        if (!Auth::user()->isAdmin() && $profile->user_id !== Auth::id()) {
            abort(403);
        }

        return view('customers.edit', compact('profile'));
    }

    /**
     * Update the specified customer profile.
     */
    public function update(Request $request, string $id)
    {
        $profile = Profile::findOrFail($id);

        if (!Auth::user()->isAdmin() && $profile->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
        ]);

        $profile->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'address' => $request->address,
            'phone'   => $request->phone,
        ]);

        return redirect()->route('customers.index')
            ->with('success', 'Customer profile updated successfully!');
    }

    /**
     * Remove the specified customer profile.
     */
    public function destroy(string $id)
    {
        $profile = Profile::findOrFail($id);

        if (!Auth::user()->isAdmin() && $profile->user_id !== Auth::id()) {
            abort(403);
        }

        $profile->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer profile deleted successfully!');
    }
}
