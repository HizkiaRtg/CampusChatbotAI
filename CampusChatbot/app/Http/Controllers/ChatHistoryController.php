<?php

namespace App\Http\Controllers;

use App\Models\ChatHistory;
use Illuminate\Http\Request;

class ChatHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = ChatHistory::with(['user', 'trainingData']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                    ->orWhere('answer', 'like', "%{$search}%");
            });
        }

        if ($request->filled('min_confidence')) {
            $query->where('confidence_score', '>=', $request->min_confidence);
        }

        if ($request->filled('max_confidence')) {
            $query->where('confidence_score', '<=', $request->max_confidence);
        }

        $chatHistories = $query->latest()->paginate(30);

        return view('admin.chat-history.index', compact('chatHistories'));
    }

    public function destroy($id)
    {
        $chatHistory = ChatHistory::findOrFail($id);
        $chatHistory->delete();

        return redirect()->route('admin.chat-history.index')
            ->with('success', 'Riwayat chat berhasil dihapus!');
    }

    public function clear(Request $request)
    {
        ChatHistory::truncate();

        return redirect()->route('admin.chat-history.index')
            ->with('success', 'Semua riwayat chat berhasil dihapus!');
    }
}
