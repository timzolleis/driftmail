<?php

namespace App\Models;

use App\Models\mail\MailStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class MailQueue extends Model
{
    use HasUuids;




    protected $table = 'mail_queue';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'job_id',
        'request_id',
        'mail_address',
        'status',
        'mail_subject',
        'mail_body',
        'failure_cause'
    ];
    public $timestamps = false;
    protected $casts = [
        'id' => 'string',
        'job_id' => 'int',
        'request_id' => 'string',
        'mail_address' => 'string',
        'status' => 'string',
    ];


}
