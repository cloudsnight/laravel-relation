<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function users()
    {
      //  WithPivot() untuk mengambil kolom lain; ex: ...->withPivot('a','b','c',...);
      // WherePivot() untuk mem-Filter data dari suatu kolom pivot; ex: ...->wherePivot('nama_kolom','kriteria');
      // WherePivotIn() untuk mem-Filter data dalam pivot kolom dengan banyak kriteria; ex: ...->withPivotIn('nama_kolom',['kriteria_1', 'kriteria_2','...']);
        return $this->belongsToMany('App\Models\User')->withTimeStamps()
                    ->withPivot('data_lain');
    }

    public function likes()
    {
      return $this->morphMany('App\Models\Like', 'likeable');
    }
}
