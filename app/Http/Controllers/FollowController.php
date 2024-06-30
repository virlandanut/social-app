<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function createFollow(User $user) {
        // you cannot follow yourself
        if($user->id == auth()->user()->id) {
            return back()->with('error', 'You cannot follow youself.');
        }
        // you cannot follow someone who you already following
        $existCheck = Follow::where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->count();

        if($existCheck) {
            return back()->with('error', 'You already follow that user.');
        }

        $newFollow = new Follow;
        $newFollow->user_id = auth()->user()->id;
        $newFollow->followeduser = $user->id;
        $newFollow->save();

        return back()->with('success', 'User successfully followed.');

    }

    public function removeFollow(User $user) {

        if($user->id == auth()->user()->id) {
            return back()->with('error', 'You cannot unfollow youself.');
        }

        $existCheck = Follow::where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->count();

        if(!$existCheck) {
            return back()->with('error', 'You are not following this user.');
        }

        Follow::where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->delete();

        return back()->with('success', 'You unfollowed the user.');

    }
}
