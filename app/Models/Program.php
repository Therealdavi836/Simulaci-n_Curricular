<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Program extends Model
{
     protected $fillable = [
        'code',
        'name',
        'faculty',
        'total_semesters',
        'is_active',
    ];

    protected $casts = [
        'is_active'       => 'boolean',
        'total_semesters' => 'integer',
    ];

    /**
     * Subjects that belong to this program
     */

    public function subjects()
    {
        return $this->hasMany(Subject::class)
                    ->orderBy('semester')
                    ->orderBy('display_order');
    }

    /**
     * Returns the grouped pensum per semester
     * Identic format of the original hardcoded array
     *  [1 => ['4200910, 1000004', ...], 2 => [Subject, Subject]...]
     */
    public function getCurriculumGrouped()
    {
        return $this->subjects()
                    ->get()
                    ->groupBy('semester')
                    ->map(fn($group) => $group->pluck('code')->all())
                    ->all();
    }
}
