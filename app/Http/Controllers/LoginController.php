<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /**
     * @return View|RedirectResponse
     */
    public function index()
    {
        if (auth()->user()) {
            return redirect()->route('admin.index');
        }

        return view('auth.login');
    }

    /**
     * @param LoginRequest $request
     *
     * @return RedirectResponse
     */
    public function attempt(LoginRequest $request): RedirectResponse
    {
        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.index');
        }

        return back()->withErrors(['Incorrect username or password.']);
    }
}
