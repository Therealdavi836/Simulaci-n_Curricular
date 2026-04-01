<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Program;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProgramSelectorController extends Controller
{
    /**
     * Return the complete hierarchy of campus → faculty → program for the modal.
     */
    public function index(): JsonResponse
    {
        $campuses = Campus::where('is_active', true)
            ->with([
                'faculties' => function ($q) {
                    $q->with([
                        'programs' => function ($q2) {
                            $q2->select(['id', 'faculty_id', 'code', 'name', 'total_semesters']);
                        }
                    ]);
                }
            ])
            ->orderBy('name')
            ->get(['id', 'code', 'name']);

        return response()->json($campuses);
    }

    /**
     * Save the selected program in the session.
     */
    public function select(Request $request): JsonResponse
    {
        $request->validate(['program_id' => 'required|exists:programs,id']);

        $program = Program::where('is_active', true)
            ->with('faculty.campus')
            ->findOrFail($request->integer('program_id'));

        session([
            'program_id'   => $program->id,
            'program_name' => $program->name,
            'faculty_name' => $program->faculty?->name,
            'campus_name'  => $program->faculty?->campus?->name,
        ]);

        return response()->json([
            'success' => true,
            'program' => [
                'id'     => $program->id,
                'name'   => $program->name,
                'faculty'=> $program->faculty?->name,
                'campus' => $program->faculty?->campus?->name,
            ]
        ]);
    }

    /**
     * Clear the program selection from the session.
     */
    public function clear(): JsonResponse
    {
        session()->forget(['program_id', 'program_name', 'faculty_name', 'campus_name']);
        return response()->json(['success' => true]);
    }
}
