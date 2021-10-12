<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $dates = ['created_at', 'updated_at', 'deadline', 'complete_date'];
    protected $guarded = ['id'];

    function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    function project()
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }
    function file()
    {
        return $this->hasMany(File::class, 'task_id', 'id');
    }
    function log()
    {
        return $this->hasMany(TaskLog::class, 'task_id', 'id');
    }
}
