<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiProvider extends Model
{
    public const STATUS_UNKNOWN = 'unknown';

    public const STATUS_CONNECTED = 'connected';

    public const STATUS_FAILED = 'failed';

    protected $fillable = [
        'name',
        'provider',
        'model',
        'api_key',
        'is_enabled',
        'connection_status',
        'connection_message',
        'last_checked_at',
    ];

    protected $hidden = [
        'api_key',
    ];

    protected function casts(): array
    {
        return [
            'api_key' => 'encrypted',
            'is_enabled' => 'boolean',
            'last_checked_at' => 'datetime',
        ];
    }
}
