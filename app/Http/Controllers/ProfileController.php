<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('app.profile', [
            'user' => $user = auth()->user(),
            'codes' => $user->codes,
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $validated = $request->validated();

        $user = $request->user();

        $user->email = Arr::get($validated, 'email');

        if (Arr::has($validated, 'password')) {
            $user->password = Hash::make(Arr::get($validated, 'password'));
        }

        if ($request->hasFile('avatar')) {
            $user->avatar = $request->file('avatar')->store('public');
        }

        $user->save();

        return redirect()->route('profile.show');
    }
}
