<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'status',
    ];

    /**
     * Get the post that owns the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
