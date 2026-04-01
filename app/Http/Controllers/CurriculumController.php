<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Subject;

class CurriculumController extends Controller
{
    public function index()
    {
        $program = $this->currentProgram();

        $subjects = Subject::where('program_id', $program->id)
            ->orderBy('semester')
            ->orderBy('name')
            ->get();

        $curriculumBySemester = [];
        for ($i = 1; $i <= $program->total_semesters; $i++) {
            $curriculumBySemester[$i] = $subjects->where('semester', $i)->values();
        }

        return view('curriculum.index', compact('curriculumBySemester', 'program'));
    }

    private function currentProgram(): Program
    {
        $programId = session('program_id');

        if ($programId) {
            return Program::where('is_active', true)->findOrFail($programId);
        }

        return Program::where('is_active', true)->firstOrFail();
    }
}
