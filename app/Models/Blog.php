<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blog';
    protected $fillable = [
        'name',
        'title',
        'description',
        'slug',
        'heading',
        'text',
        'image',
        'published',
        'author',
    ];


    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }


}
