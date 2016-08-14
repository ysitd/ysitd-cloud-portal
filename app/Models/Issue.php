<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{

    protected $fillable = [
        'title', 'owner',
        'service', 'category', 'detail'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(IssueComment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'owner', 'user_id');
    }
}