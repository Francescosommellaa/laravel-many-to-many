<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'programming_language_id',
        'slug',
        'img',
        'thumbnail_img',
        'website_url'
    ];

    public function programming_language()
    {
        return $this->belongsTo(ProgrammingLanguage::class);
    }
}
