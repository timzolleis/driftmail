<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectConfiguration extends Model
{
    protected $table = 'project_configurations';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'project_id',
        'api_key',
    ];
    public $timestamps = false;
    protected $casts = [
        'id' => 'string',
        'project_id' => 'string',
        'api_key' => 'string',
    ];


}
