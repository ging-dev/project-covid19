<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('login');
    }

    public function callback(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'string|required|size:32',
        ]); // Bonk!

        $data = Http::get('http://ulogin.ru/token.php', [
            'token' => $request->post('token'),
        ])->json();

        /** @var User */
        $user = User::firstOrCreate(
            Arr::only($data, 'uid'),
            Arr::only($data, ['first_name', 'last_name', 'photo'])
        );

        Auth::loginUsingId($user->id, true);

        return redirect()->route('home');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
