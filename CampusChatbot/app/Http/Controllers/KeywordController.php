<?php

namespace App\Http\Controllers;

use App\Models\TrainingData;
use App\Models\Keyword;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function index($id)
    {
        $trainingData = TrainingData::findOrFail($id);
        $keywords = $trainingData->keywords()->orderBy('weight', 'desc')->get();
        return view('admin.keywords.index', compact('trainingData', 'keywords'));
    }

    public function store(Request $request, $id)
    {
        $trainingData = TrainingData::findOrFail($id);

        $validated = $request->validate([
            'keyword' => 'required|string|max:100',
            'weight' => 'required|numeric|min:0.1|max:2.0',
        ]);

        $trainingData->keywords()->create($validated);

        return redirect()->route('admin.keywords.index', $id)
            ->with('success', 'Keyword berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $keyword = Keyword::findOrFail($id);
        $trainingDataId = $keyword->training_data_id;
        $keyword->delete();

        return redirect()->route('admin.keywords.index', $trainingDataId)
            ->with('success', 'Keyword berhasil dihapus!');
    }
}
