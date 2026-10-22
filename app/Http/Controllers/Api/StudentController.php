<?php

namespace App\Http\Controllers\Api;
use App\Models\Student;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = \App\Models\Student::where('school_id', 1)->paginate(10);
        return response()->json($students);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_id' => 'required|exists:school,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'class_name' => 'required|string',
            'is_boarder' => 'boolean',
            'parent_name' => 'nullable|string',
            'parent_phone' => 'nullable|string',
            'parent_address' => 'nullable|string',
        ]);


        $currentYear = date('Y');
 
        $lastStudent = \App\Models\Student::where('school_id', $request->school_id)
            ->where('admission_no', 'LIKE', $currentYear . '%')
            ->orderBy('id', 'desc')
            ->first();

        $nextSequence = 1;

        if ($lastStudent && !empty($lastStudent->admission_no)) {
            $lastNumericPart = substr($lastStudent->admission_no, 4);
            $nextSequence = intval($lastNumericPart) + 1;
        }

        $addmissionNo = $currentYear . str_pad($nextSequence, 4, '0', STR_PAD_LEFT);
        $accountNo = $request->school_id . '0000' . str_pad($nextSequence, 5, '0', STR_PAD_LEFT);


        $student = Student::create([
            'school_id' => $validated['school_id'],
            'admission_no' => $addmissionNo ,
            'account_no' => $accountNo,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'class_name' => $validated['class_name'],
            'is_boarder' => $request->is_boarder ?? false,
            'parent_name' => $validated['parent_name'] ?? null,
            'parent_phone' => $validated['parent_phone'] ?? null,
            'parent_address' => $validated['parent_address'] ?? null,
        ]);

        return response()->json([
            'message' => 'Student registered successfully',
            'student' => $student
        ], 201);
    }
}
