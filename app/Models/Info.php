<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $table = 'information';

    protected $fillable = ['title', 'icon', 'content', 'visible', 'editor'];

    public function info()
    {
        return $this->hasMany(Info::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
