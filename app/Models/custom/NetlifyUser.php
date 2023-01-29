<?php

namespace App\Models\custom;

use App\Models\Project;
use App\Models\Template;
use App\Models\Variable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class NetlifyUser extends Authenticatable
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

    public function projects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function variables(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Variable::class);
    }

    public function templates(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Template::class);
    }
}
