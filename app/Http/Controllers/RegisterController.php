<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\Code;
use App\Services\RegisterUserService;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => [
                'required',
                Rule::exists(Code::class)->where(
                    fn(Builder $query) => $query->whereNull('consumed_at')->whereNull('guest_id')
                ),
            ]
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator, 'register');
        }

        $validated = $validator->validated();

        $code = Code::where('code', Arr::get($validated, 'code'))->firstOrFail();

        return redirect()->route('register.terms', $code);
    }

    public function terms(Code $code)
    {
        Gate::authorize('register', $code);

        $code->loadMissing(['host']);

        return view('auth.signup-terms', ['code' => $code]);
    }

    public function verifyTerms(Request $request, Code $code)
    {
        Gate::authorize('register', $code);

        $request->validate([
            'terms' => ['accepted'],
        ]);

        return redirect()->route('register', $code);
    }

    public function create(Code $code)
    {
        Gate::authorize('register', $code);

        $code->loadMissing(['host']);

        return view('auth.signup-account', ['code' => $code]);
    }

    public function store(RegisterUserRequest $request, Code $code, RegisterUserService $service)
    {
        Gate::authorize('register', $code);

        $user = $service->execute($request->validated(), $code);

        Auth::login($user);

        return redirect()->route('home');
    }
}
