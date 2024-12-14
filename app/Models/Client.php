<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Client extends Model
{

    use Searchable;
    protected $fillable = ['name'];

    public function informations(): HasMany
    {
        return $this->hasMany(Information::class);
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'informations' => $this->informations->map(function ($information) {
                return [
                    'client_id' => $information->client_id,
                    'url' => $information->url,
                    'server' => $information->server,
                    'environment' => $information->environment,
                ];
            })->toArray(),
        ];
    }
}
