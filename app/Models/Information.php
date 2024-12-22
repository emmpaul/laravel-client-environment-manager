<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Information extends Model
{
    protected $fillable = ['url', 'server', 'environment', 'client_id'];

    protected $table = 'informations';

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
