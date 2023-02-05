<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasUuids;

    protected $table = 'projects';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'name',
        'description',
        'active'
    ];
    public $timestamps = false;
    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'description' => 'string',
        'avatar_url' => 'boolean',
    ];

    public function config(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProjectConfiguration::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function templates(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Template::class);
    }

    public function variables(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Variable::class);
    }

    public function settings()
    {
        return $this->hasOne(ProjectSettings::class);
    }


}
