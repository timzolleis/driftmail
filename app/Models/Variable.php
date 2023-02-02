<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(string $id)
 */
class Variable extends Model
{
    use HasUuids;

    protected $table = 'variables';
    protected $keyType = 'string';
    protected $fillable = [
        'key',
        'value',
        'description',
        'scope',
        'project_id'
    ];
    public $timestamps = false;
    protected $casts = [
        'key' => 'string',
        'value' => 'string',
        'description' => 'string',
        'scope' => 'string',
    ];

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class);
    }


}
