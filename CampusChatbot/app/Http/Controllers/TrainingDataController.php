<?php

namespace App\Http\Controllers;

use App\Models\TrainingData;
use Illuminate\Http\Request;

class TrainingDataController extends Controller
{
    public function index(Request $request)
    {
        $query = TrainingData::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                    ->orWhere('answer', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }

        $trainingData = $query->orderBy('priority', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $categories = TrainingData::distinct()->pluck('category');

        return view('admin.training-data.index', compact('trainingData', 'categories'));
    }

    public function create()
    {
        $categories = TrainingData::distinct()->pluck('category');
        return view('admin.training-data.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'required|string|max:100',
            'priority' => 'required|integer|min:0|max:10',
            'is_active' => 'accepted',
        ]);

        $validated['is_active'] = $request->has('is_active');

        TrainingData::create($validated);

        return redirect()->route('admin.training-data.index')
            ->with('success', 'Data training berhasil ditambahkan!');
    }

    public function show(TrainingData $trainingData)
    {
        return view('admin.training-data.show', compact('trainingData'));
    }

    public function edit($id)
    {
        $trainingData = TrainingData::findOrFail($id);
        $categories = TrainingData::distinct()->pluck('category');
        return view('admin.training-data.edit', compact('trainingData', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $trainingData = TrainingData::findOrFail($id);

        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'required|string|max:100',
            'priority' => 'required|integer|min:0|max:10',
            'is_active' => 'accepted',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $trainingData->update($validated);

        return redirect()->route('admin.training-data.index')
            ->with('success', 'Data training berhasil diupdate!');
    }

    public function destroy($id)
    {
        $trainingData = TrainingData::findOrFail($id);
        $trainingData->delete();

        return redirect()->route('admin.training-data.index')
            ->with('success', 'Data training berhasil dihapus!');
    }

    public function toggle($id)
    {
        $trainingData = TrainingData::findOrFail($id);
        $trainingData->is_active = !$trainingData->is_active;
        $trainingData->save();

        return response()->json([
            'success' => true,
            'is_active' => $trainingData->is_active,
        ]);
    }
}
