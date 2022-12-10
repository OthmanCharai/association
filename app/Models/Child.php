<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'gender',
        'birth_day',
        'educated',
        'vaccinated',
        'widow_id',
        'sponsor_id',
    ];

    protected $appends=['age'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'birth_day' => 'date',
        'educated' => 'boolean',
        'vaccinated' => 'boolean',
        'widow_id' => 'integer',
        'sponsor_id' => 'integer',
    ];



    public function widow()
    {
        return $this->belongsTo(Widow::class);
    }

    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class);
    }

    public function getAgeAttribute(){
        return $this->birth_day->format(' d M   y');
    }
}
