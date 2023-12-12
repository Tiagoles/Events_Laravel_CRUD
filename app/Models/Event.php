<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'date', 'city', 'description', 'image', 'private', 'items'];

    protected $casts = [
        "items" => "array",
    ];
    protected $date = ["date"];
    public function user()
    {
        return $this->belongsTo("App\\Models\\User");
    }
    public function users(){
        $this->belongsToMany("App\\Models\\User");
    }
}
