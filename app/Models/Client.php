<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'second_last_name'
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
