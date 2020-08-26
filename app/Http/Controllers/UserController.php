<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function list(){
        $users = User::select('*')->get();

        return response()->json($users);
    }

    public function register (Request $request) {
        // If you are registered it returns your links, else it makes you a new user
        $this->validate($request, [
            'email' => 'required|string|email|max:255',
            // 'name' => 'required|string|max:255',
            // 'password' => 'required|string|min:6',
        ]);

        $user_db = User::where('email', $request->email)->firstOr(function () {
        });
        if (!isset($user_db)) {
            $user = User::create([
                'email' => $request->email,
                'profile_hash' => hash('ripemd160', $request->email .Carbon::now()->toDateTimeString())
                // 'name' => $request->name,
                // 'password' => Hash::make($request->password),
            ]);

            return $user;
        }
        return $user_db;
    }

    /**
     *  Returns the user with the tags he have
     */
    public function getByHash (Request $request, $hash) {
        if (!isset($hash)) {
            return;
        }
        $user = User::where('profile_hash', $hash)->with('tags')->first();
        return response()->json($user);
    }
}
