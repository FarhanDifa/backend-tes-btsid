<?php

namespace App\Http\Controllers;

use App\Models\ChecklistItem;
use Illuminate\Http\Request;

class ChecklistItemController extends Controller
{
    public function index($checklistId)
    {
        $query = ChecklistItem::query([
            'checklist_id' => $checklistId
        ]);

        $checklist = $query->get();

        return response()->json([
            'data' => $checklist,
            'status' => 200
        ]);
    }

    public function store(Request $request, $checkListId)
    {
        $model = new ChecklistItem();
        
        $model->checklist_id = $checkListId;
        $model->title = $request->title;
        $model->description = $request->description;

        $model->created_at = now();
        $request->validate([
            'title' => 'required'
        ]);
        

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

    public function show($checkListId,$checkListItemId)
    {
        $model = ChecklistItem::query([
            'id' => $checkListItemId,
            'checklist_id' => $checkListId
        ])->first();

        if($model == null)
        {
            return response()->json([
                'message' => 'Id tidak ditemukan',
                'status' => 404
            ]);
        }

        if($model)
        {
            return response()->json([
                'data' => $model,
                'message' =>'Data Berhasil ditemukan',
                'status' => 200
            ],200);
        }

        return response()->json(['message' =>'Data tidak ditemukan'],500);
    }

    public function updateStatus(Request $request, $checkListId, $checkListItemId)
    {
        $model = ChecklistItem::query([
            'id' => $checkListItemId,
            'checklist_id' => $checkListId
        ])->first();

        if($model == null)
        {
            return response()->json([
                'message' => 'Id tidak ditemukan',
                'status' => 404
            ]);
        }

        if($model)
        {
            $model->is_completed = $request->is_completed;
            $model->save();

            return response()->json([
                'message' => 'Status berhasil diubah',
                'status' => 200
            ]);
        }

        return response()->json([
            'message' => 'Status gagal diubah',
            'status' => 500
        ]);
    }

    public function delete($checkListId, $checkListItemId)
    {
        $checklistItem = ChecklistItem::query([
            'id' => $checkListItemId,
            'checklist_id' => $checkListId
        ])->firstOrFail();

        if($checklistItem == null)
        {
            return response()->json([
                'message' => 'Id tidak ditemukan',
                'status' => 404
            ]);
        }

        if($checklistItem->delete())
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

    public function update(Request $request,$checkListId,$checkListItemId)
    {
        $checklistItem = ChecklistItem::query([
            'id' => $checkListItemId,
            'checklist_id' => $checkListId
        ])->first();

        if($checklistItem == null)
        {
            return response()->json([
                'message' => 'Id tidak ditemukan',
                'status' => 404
            ]);
        }

        $request->validate([
            'title' => 'required'
        ]);

        $checklistItem->loadFillable($request->all());

        if($checklistItem->save())
        {
            return response()->json([
                'message' => 'Data berhasil diupdate',
                'status' => 200
            ]);
        }

        return response()->json([
            'message' => 'Data gagal diupdate',
            'status' => 500
        ]);
    }
}
