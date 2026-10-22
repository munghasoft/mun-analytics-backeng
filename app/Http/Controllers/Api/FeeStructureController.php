<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeStructure;
use App\Models\FeeStructureItem;

class FeeStructureController extends Controller
{
    //
    public function index(Request $request)
    {
        $fees = FeeStructure::where('school_id', 1)
        ->where('year', $request->query('year'))
        ->where('term', $request->query('term'))
        ->get();

    return response()->json($fees);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_id' => 'required|exists:school,id',
            'class_name' => 'required|string',
            'term' => 'required|string',
            'year' => 'required|integer',
            'total_day' => 'required|numeric',
            'total_boarder' => 'required|numeric',
            'items.*.name' => 'required|string',
            'items.*.amount' => 'required|numeric',

            'items' => 'required|array|min: 1',
            'items.*.name' => 'required|string',
            'items.*.amount' => 'required|numeric',
        ]);

        $feeStructure = FeeStructure::create([
            'school_id' => $validated['school_id'],
            'class_name' => $validated['class_name'],
            'term' => $validated['term'],
            'year' => $validated['year'],
            'total_day' => $validated['total_day'],
            'total_boarder' => $validated['total_boarder'],
        ]);

        foreach ($validated['items'] as $item) {
            FeeStructureItem::create([
                'fee_structure_id' => $feeStructure->id,
                'name' => $item['name'],
                'amount' => $item['amount'],
            ]);
        }

        return response()->json([
            'message' => 'Fee Structure Saved Successfully',
            'fee_structure' => $feeStructure
        ], 201);
    }
}
