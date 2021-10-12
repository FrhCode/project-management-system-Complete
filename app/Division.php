<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    //
    protected $fillable = [
        'title',
        'name',
    ];

    function leader()
    {
        return $this->hasMany(User::class, 'division_id', 'id')->where('users.occupation_id', 2);
    }

    function member()
    {
        return $this->hasMany(User::class, 'division_id', 'id')->where('users.occupation_id', 3);
    }

    function user()
    {
        return $this->hasMany(User::class, 'division_id', 'id')->orderBy('users.occupation_id', 'asc');
    }
}
