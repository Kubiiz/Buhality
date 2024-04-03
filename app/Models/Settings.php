<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = ['app_name', 'description', 'keywords', 'random', 'age', 'editor',];

    // Get settings value
    public static function value(string $value) :string
    {
        $query = Settings::first();
        $return = $query->$value;

        return $return;
    }
}
