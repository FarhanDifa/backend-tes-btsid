<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function index()
    {
        $query = Checklist::query();

        $checklist = $query->get();

        return response()->json([
            'data' => $checklist,
            'status' => 200
        ]);
    }

    public function store(Request $request)
    {
        $model = new Checklist();
        $request->validate([
            'title' => 'required'
        ]);

        $model->loadFillable($request->all());
        $model->created_at = now();

        if($model->save())
        {
            return response()->json([
                'message' =>'Data Berhasil ditambahkan',
                'status' => 200
            ]);
        }

        return response()->json([
            'message' =>'Data gagal ditambahkan',
            'status' => 500
        ]);
    }

    public function delete($checklistId)
    {
        $checklist = Checklist::query([
            'id' => $checklistId
        ])->first();

        if($checklist == null)
        {
            return response()->json([
                'message' => 'Id tidak ditemukan',
                'status' => 404
            ]);
        }

        if($checklist->delete())
        {
            return response()->json([
                'message' => 'Data berhasil dihapus',
                'status' => 200
            ]);
        }

        return response()->json([
            'message' => 'Data gagal dihapus',
            'status' => 500
        ]);
    }
}
