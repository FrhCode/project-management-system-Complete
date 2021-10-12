<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $dates = ['created_at', 'updated_at', 'start_date', 'end_date'];

    protected $guarded = ['id'];
    // Getter
    // function getStartDateAttribute($value)
    // {
    //     return substr($value, 0, 10);
    // }

    // function getEndDateAttribute($value)
    // {
    //     return substr($value, 0, 10);
    // }

    // Project Model
    public function task()
    {
        return $this->hasMany(Task::class, 'project_id', 'id')->orderBy('deadline', 'ASC');
    }

    public function log()
    {
        return $this->hasMany(Log::class, 'project_id', 'id')->latest();
    }

    public function file()
    {
        return $this->hasManyThrough(File::class, Task::class);
    }
}
