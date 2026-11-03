<?php

namespace App\Http\Controllers\Api;
use App\Models\Student;
use App\Models\FeeStructure;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // Default academic year
        $academicYear = 2026;
        $term = 'Term 1';

        //Get fee structure for selected academic period

        $feeStructures = FeeStructure::where('school_id',1)
            ->where('year', $academicYear)
            ->where('term', $term)
            ->get()
            ->keyBy('class_name');
        
        //get student and their approved cash payment totals


        $students = \App\Models\Student::where('school_id', 1)
            ->withSum([
                'payments as total_paid' => function ($query) {
                    $query->where('method', 'Cash')
                    ->where('status', 'approved');
                }
            ], 'amount')->paginate(10);

        //Calculate the correct fees for each student

        $students->getCollection()->transform(function ($student) use ($feeStructures) {

        $fee = $feeStructures->get($student->class_name);

        //Provide both available fee amounts to react

        $student->fee_day = $fee ? (float) $fee->total_day : 0;
        $student->fee_boarder = $fee ? (float) $fee->total_boarder : 0;

        //Use the student saved fee category

        $student->billed = $student->fee_category === 'boarder'
            ? $student->fee_boarder
            : $student->fee_day;

        /*
        if ($fee) {
            if ($student->fee_category === 'boarder') {
                $student->billed = (float)
                $fee->total_boarder;
            } else {
                $student->billed = (float)
                $fee->total_day;
            }
        } else {
            $student->billed = 0;
        } 
        */

        //calculate the outstanding balance

        $student->balance = max (
            0, $student->billed - (float) ($student->total_paid ?? 0)
        );
        return $student;
        });

        return response()->json($students);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_id' => 'required|exists:school,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'class_name' => 'required|string',
            'is_boarder' => 'sometimes|boolean',
            'fee_category' => 'sometimes|in:day,boarder',
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

        // Use explicitly supplied category if provieded
        //Otherwise preserve the existing registration choices

        $isBoarder = (bool) ($validated['is_boarder'] ?? false);
        $feeCategory = $validated['fee_category'] ?? ($isBoarder ? 'boarder' : 'day');


        $student = Student::create([
            'school_id' => $validated['school_id'],
            'admission_no' => $addmissionNo ,
            'account_no' => $accountNo,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'class_name' => $validated['class_name'],
            'is_boarder' => $isBoarder,
            'fee_category' => $feeCategory,
            'parent_name' => $validated['parent_name'] ?? null,
            'parent_phone' => $validated['parent_phone'] ?? null,
            'parent_address' => $validated['parent_address'] ?? null,
        ]);

        return response()->json([
            'message' => 'Student registered successfully',
            'student' => $student
        ], 201);
    }

    public function updateFeeCategory(Request $request, $id)
    {
        // Accept only two supported fee categories
        $validated = $request->validate([
            'fee_category' => 'required|in:day,boarder',
        ]);

        // Find the student belonging the current test school

        $student = Student::where('school_id',1)
            ->findOrFail($id);
        

        //Save selected category permanently
        $student->fee_category = $validated['fee_category'];
        $student->save();

        return response()->json([
            'message' => 'Student fee category updated successfully',
            'student' => $student,
        ]);
    }
}
