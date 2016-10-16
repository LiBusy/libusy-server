<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibraryBusyness extends Model
{
    protected $table = 'library_busyness';
    public $timestamps = false;
    protected $fillable = ['level', 'library', 'timestamp'];
}
