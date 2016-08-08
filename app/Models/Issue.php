<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    public function comments()
    {
        return $this->hasMany(IssueComment::class);
    }
}