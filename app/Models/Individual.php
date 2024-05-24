<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Individual extends Model
{
    use HasFactory;

    protected $fillable = [
        "name","content", "status", "date_of_birth", "date_of_death","upload_id", "category_id"
    ];

    public function image()
    {
        return $this->belongsTo(Upload::class, 'upload_id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}