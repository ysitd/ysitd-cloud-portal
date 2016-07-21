<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'account_id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}