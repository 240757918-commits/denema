<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LessonContent;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'language',
        'level',
    ];

    // 👇 هون بتحطي الكود
    public function contents()
    {
        return $this->hasMany(LessonContent::class)->orderBy('order');
    }
}
