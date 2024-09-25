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
        'slug',
        'img',
        'thumbnail_img',
        'website_url'
    ];

    public function programmingLanguage()
    {
        return $this->belongsTo(ProgrammingLanguage::class);
    }
    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}
