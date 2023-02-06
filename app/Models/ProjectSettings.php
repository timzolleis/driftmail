<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ProjectSettings extends Model
{
    use HasUuids;

    protected $table = 'project_settings';
    protected $keyType = 'string';
    protected $fillable = [
        'mail_host',
        'api_key',
        'mail_port',
        'mail_user',
        'mail_password',
        'mail_sending_address',
        'mail_sending_name',
        'test_mail_receiver'
    ];
    public $timestamps = false;
    protected $casts = [
        'mail_host' => 'string',
        'api_key' => 'string',
        'mail_port' => 'string',
        'mail_user' => 'string',
        'mail_password' => 'string',
        'mail_sending_address' => 'string',
        'mail_sending_name' => 'string',
        'test_mail_receiver' => 'string',
    ];

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

}
