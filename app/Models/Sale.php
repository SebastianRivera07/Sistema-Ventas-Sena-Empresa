<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'total_value',
        'date',
        'user_id',
        'client_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function details()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
