<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Passport;
use App\Models\Lesson;
use App\Models\Forum;

class UserController extends Controller
{
    public function showProfile($id)
    {
        // Eager loading untuk menghemat eksekusi pemanggilan query
        // Menggunakan with()->...

        // $user = User::with('forums')->where('id', $id)->first();

        // Eager loading dengan syarat tertentu :
         //   $user = User::with(['forums' => function($query){
         //       $query->where('title', 'like', '%banten%');
         //   }])->where('id', $id)->first();

         // Eager loading dengan tabel lebih dari satu :
         // $user = User::with('forums', 'lessons')->where('id', $id)->first();

         // Nested eager loading :
         $user = User::with('forums.tags')->where('id', $id)->first();
      
         return view('user.profile', ['user' => $user]);
    }

    public function showPassport($id)
    {
        return view('user.passport', ['passport' => Passport::findOrFail($id)]);
    }

    public function showLesson($id)
    {
        return view('user.lesson', ['lesson' => Lesson::findOrFail($id)]);
    }

    public function showForum($id)
    {
        return view('user.forum', ['forum' => Forum::findOrFail($id)]);
    }
}
