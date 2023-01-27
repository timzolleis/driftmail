<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ProjectConfiguration extends Model

{
    use HasUuids;

    protected $table = 'project_configurations';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'project_id',
        'api_key',
        'mail_host',
        'mail_port',
        'mail_user',
        'mail_password',
        'mail_sending_address',
        'mail_test_receiver'
    ];
    public $timestamps = false;
    protected $casts = [
        'id' => 'string',
        'project_id' => 'string',
        'api_key' => 'string',
    ];

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class);
    }


}
