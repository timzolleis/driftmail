<?php

namespace App\Models\custom;

use Illuminate\Database\Eloquent\Model;

class NetlifyUser extends Model
{

    protected $table = 'netlify_users';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'email',
        'avatar_url'
    ];

    public $timestamps = false;

    protected $casts = [
        'id' => 'string',
        'email' => 'string',
        'avatar_url' => 'string',
    ];
}
