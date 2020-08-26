<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;
use App\User;
use App\Pomodoro;

class TagController extends Controller
{
    public function create(Request $request){

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'profile_hash' => 'required|string|max:255'
        ]);

        $user = User::where('profile_hash', $request->profile_hash)->first();
        if (isset($user)){

            $new_tag = new Tag();
            $new_tag->name = $request->name;
            $new_tag->save();

            $user->tags()->attach($new_tag->id);

            return response()->json([
                $user,
                $new_tag
            ]);
        }

        return response()->json('500');
    }

    public function addTag(Request $request){

        $this->validate($request, [
            'profile_hash' => 'required|string|max:255',
            'pomodoro_id' => 'required|numeric|gt:0',
            'tag_id' => 'required|numeric|gt:0',
        ]);

        $user = User::where('profile_hash', $request->profile_hash)->first();
        $tag = Tag::where('id', $request->tag_id)->first();
        $pomodoro = Pomodoro::where('id', $request->pomodoro_id)->first();

        if (isset($user) &&
            isset($tag) &&
            isset($pomodoro)
            ) {

            // $pomodoro::has()
            $pomodoro->tags()->attach($tag->id);
            $pomodoro->save();

            return response()->json($pomodoro);
        }
    }

    public function delete(Request $request){
        $this->validate($request, [
            'tag_id' => 'required|numeric|gt:0',
            'hash' => 'required|string',
        ]);

        $user = User::where('profile_hash', $request->hash)->first();
        $user->tags()->detach($request->tag_id);
        Tag::destroy($request->tag_id);
        // $return_value = $deleted->user()->id;
        return $user;
    }
}
