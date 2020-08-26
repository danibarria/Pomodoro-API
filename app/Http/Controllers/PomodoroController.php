<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\User;
use App\Pomodoro;

class PomodoroController extends Controller
{
    public function create(Request $request){

        $this->validate($request, [
            'seconds' => 'required|numeric|gt:0',
            'profile_hash' => 'required|string|max:255',
        ]);

        $user = User::where('profile_hash', $request->profile_hash)->first();

        if (isset($user)){
            $pomodoro = new Pomodoro();

            $pomodoro->seconds = $request->seconds;
            $pomodoro->user_id = $user->id;

            $pomodoro->save();

            return response()->json($pomodoro);
        }
    }

    public function lastMonth(Request $request, $hash){
        // year 2020
        // month 1 - 12
        $user = User::where('profile_hash', $hash)->first();

        $pomodoros = $user->pomodoros()
                    ->whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->with('tags')
                    ->get();

        return response()->json($pomodoros);
    }
    public function index(){
        return 'index';
    }
}
