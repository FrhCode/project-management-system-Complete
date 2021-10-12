<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function occupation()
    {
        return $this->hasOne(Occupation::class, 'id', 'occupation_id');
    }

    public function division()
    {
        return $this->hasOne(Division::class, 'id', 'division_id');
    }

    // public function leader()
    // {
    //     return $this->hasOne();
    // }

    public function project()
    {
        return $this->hasMany(Project::class, 'division_id', 'division_id');
    }

    public function task()
    {
        return $this->hasMany(Task::class, 'user_id', 'id');
    }
}
