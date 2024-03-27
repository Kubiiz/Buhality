<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'address',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function apartment()
    {
        return $this->hasMany(Apartment::class);
    }
}
