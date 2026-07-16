<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'first_name',
    'last_name',
    'email',
    'student_number',
    'year_level',
    'course',
])]
class Student extends Model
{
    use HasFactory;

    /**
     * Available year levels keyed by stored value.
     *
     * @return array<int, string>
     */
    public static function yearLevels(): array
    {
        return [
            1 => '1st Year',
            2 => '2nd Year',
            3 => '3rd Year',
            4 => '4th Year',
        ];
    }

    /**
     * Available courses keyed by stored value.
     *
     * @return array<string, string>
     */
    public static function courses(): array
    {
        return [
            'BSIT' => 'Bachelor of Science in Information Technology (BSIT)',
            'BSCS' => 'Bachelor of Science in Computer Science (BSCS)',
            'BSIS' => 'Bachelor of Science in Information Systems (BSIS)',
            'BSBA' => 'Bachelor of Science in Business Administration (BSBA)',
            'BSA' => 'Bachelor of Science in Accountancy (BSA)',
            'BSEE' => 'Bachelor of Science in Electrical Engineering (BSEE)',
            'BSCE' => 'Bachelor of Science in Civil Engineering (BSCE)',
            'BSME' => 'Bachelor of Science in Mechanical Engineering (BSME)',
            'BSECE' => 'Bachelor of Science in Electronics Engineering (BSECE)',
            'BSMT' => 'Bachelor of Science in Medical Technology (BSMT)',
            'BSN' => 'Bachelor of Science in Nursing (BSN)',
            'BSED' => 'Bachelor of Secondary Education (BSED)',
            'BEED' => 'Bachelor of Elementary Education (BEED)',
            'BSHM' => 'Bachelor of Science in Hospitality Management (BSHM)',
            'BSTM' => 'Bachelor of Science in Tourism Management (BSTM)',
        ];
    }

    /**
     * Get the student's full name.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the human-readable year level label.
     */
    public function getYearLevelLabelAttribute(): string
    {
        return static::yearLevels()[$this->year_level] ?? (string) $this->year_level;
    }
}
