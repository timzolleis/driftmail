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
        'id',
        'key',
        'value',
        'description',
        'is_global'
    ];
    public $timestamps = false;
    protected $casts = [
        'id' => 'string',
        'key' => 'string',
        'value' => 'string',
        'description' => 'string',
        'is_global' => 'string',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
