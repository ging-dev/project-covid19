<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function callback(Request $request)
    {
        $request->validate([
            'token' => 'string|required|size:32',
        ]); // Bonk!

        $data = Http::get('http://ulogin.ru/token.php', [
            'token' => $request->post('token'),
        ])->object();

        /** @var User */
        $user = User::firstOrCreate(['uid' => $data->uid], [
            'name' => name($data->first_name, $data->last_name),
            'photo' => $data->photo_big,
        ]);

        Auth::loginUsingId($user->id, true);

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
