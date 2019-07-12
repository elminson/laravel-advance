<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function getUsersCountAttribute()
    {
        return \DB::table('users')->where('users.team_id', $this->id)->sum('users.id');
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords($value);
    }

    public $appends = ['users_count'];
}
