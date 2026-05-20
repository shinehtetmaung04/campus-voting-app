<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class selection extends Model
{
   protected $table = 'selection'; // important (not plural)

    protected $primaryKey = 'sel_id';

    public $timestamps = false; // no created_at / updated_at
     // App\Models\Selection.php
public function images()
{
    return $this->hasMany(Image::class, 'sel_id', 'sel_id')->orderBy('img_id'); // order so K1.1, K1.2, K1.3
}



}
