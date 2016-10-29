<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $table = 'markers';
    public $timestamps = false;
    //protected $fillable = ['lat', 'lng', 'timestamp'];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float'
    ];

    protected $appends = ['snippet'];

    public function getSnippetAttribute()
    {
        $busyness = LibraryBusyness::where('library', '=', $this->attributes['library'])->avg('level');
        return $this->attributes['snippet'] = $busyness;
    }
}
