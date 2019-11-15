<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Passport;
use App\Models\Lesson;
use App\Models\Forum;
use App\Models\City;

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

        //  hasManyThrough
        //  dd(City::find($id)->forums);

         // Nested eager loading :
         $user = User::with('forums.tags')->where('id', $id)->first();
         $userForumCount = User::withCount('forums')->get();
      
         return view('user.profile', ['user' => $user, 'userForumCount' => $userForumCount]);
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


    // -- kasus dibawah ini hanya berlaku pada relasi belongsTo ----------------------------
    // -------------------------------------------------------------------------------------
    public function createForum()
    {
        // insert relation dengan metode save()
        // $forum = new Forum([
        //     'title' => 'test forum baru',
        //     'body' => 'body test forum baru'
        // ]);

        // $user = User::find(2); //Mengambil user id yang ke-dua

        // // eksekusi tuk menyimpan
        // $user->forums()->save($forum);

        // insert relation dengan metode create()
        $user = User::find(2);
        // eksekusi tuk menyimpan-nya
        $user->forums()->create([
            'title' => 'test forum terbaru',
            'body' => 'body test forum terbaru dengan metode create'
        ]);
    }

    public function updateForum()
    {
        // tahap 1 : cari di table forums dengan id 4
        $forum = Forum::find(4);
        // tahap 2 : User_id diubah menjadi id 3
        $user = User::find(3);
        // tahap 3 : eksekusi
        $forum->user()->associate($user);
        $forum->save();
    }

    public function deleteForum()
    {
        // metode delete ini hanya mendelete user_id dalam tabel forums. Tidak mendelete kena satu row dari tabel forum.

        // tahap 1 : cari id 3 di tabel forums
        $forum = Forum::find(3);

        // tahap 2 : eksekusi
        $forum->user()->dissociate();
        $forum->save();
    }

    // -----------------------------------------------------------------
    // ----------------------------------------------------------------- end case


    // -- kasus dibawah ini hanya berlaku pada relasi many to many ----------------------------
    // -------------------------------------------------------------------------------------

    public function createLesson()
    {
        // tahap 1 : ambil id user ke 1
        $user = User::find(1);
        // tahap 2 : eksekusi dengan menambahkan id 3 pada tabel lesson_user
        $user->lessons()->attach(3);
    }

    public function deleteLesson()
    {
        // tahap 1 : ambil id user ke 1
        $user = User::find(1);
        // tahap 2 : eksekusi dengan menghapus id 3 pada tabel lesson_user
        $user->lessons()->detach(3);
    }

    // update existin pivot on lesson_user table
    public function updateLesson()
    {
        // tahap 1 : cari user id 1 pada table lesson_user
        $user = User::find(1);
        // tahap 2 : membuat atribut untuk mengganti nilai dari kolom
        $attributes = [
            'data_lain' => 'coto'
        ];
        // tahap 3 : eksekusi tuk update dengan keterangan lesson_id yang ke 1
        $user->lessons()->updateExistingPivot(1, $attributes);
    }

    public function syncLesson()
    {
        // tahap 1 : cari user id 1
        $user = User::find(1);
        // tahap 2 : membuat list data mana yg harus tetap ada
        $lists = [1,2];
        // tahap 3 : eksekusi sync
        $user->lessons()->sync($lists);
    }

    // -----------------------------------------------------------------
    // ----------------------------------------------------------------- end case
}
