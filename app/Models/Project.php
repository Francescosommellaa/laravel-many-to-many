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
        'img',
        'img_original_name',
        'thumbnail_img',
        'thumbnail_original_name',
        'website_url',
        'slug'
    ];

    public function programmingLanguage()
    {
        return $this->belongsTo(ProgrammingLanguage::class, 'programming_language_id');
    }
    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}
