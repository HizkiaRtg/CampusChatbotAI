<?php

namespace App\Http\Controllers;

use App\Models\TrainingData;
use App\Models\ChatHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_training' => TrainingData::count(),
            'active_training' => TrainingData::where('is_active', 1)->count(),
            'total_chats' => ChatHistory::count(),
            'total_users' => User::where('role', 'user')->count(),
        ];

        $recentChats = ChatHistory::with(['user', 'trainingData'])
            ->latest()
            ->take(10)
            ->get();

        $categoryStats = TrainingData::select('category', DB::raw('count(*) as total'))
            ->where('is_active', 1)
            ->groupBy('category')
            ->get();

        $lowConfidenceChats = ChatHistory::where('confidence_score', '<', 50)
            ->where('confidence_score', '>', 0)
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentChats', 'categoryStats', 'lowConfidenceChats'));
    }
}
