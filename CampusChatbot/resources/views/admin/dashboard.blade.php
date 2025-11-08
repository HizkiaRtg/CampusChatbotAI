@extends('layouts.admin')

@section('title', 'Dashboard - Admin')
@section('page-title', 'Dashboard')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stats-label">Total Training Data</div>
                        <div class="stats-number">{{ $stats['total_training'] }}</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-database"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card" style="border-left-color: #28a745;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stats-label">Data Aktif</div>
                        <div class="stats-number">{{ $stats['active_training'] }}</div>
                    </div>
                    <div class="stats-icon" style="background: linear-gradient(135deg, #28a745, #34ce57);">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card" style="border-left-color: #17a2b8;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stats-label">Total Chat</div>
                        <div class="stats-number">{{ $stats['total_chats'] }}</div>
                    </div>
                    <div class="stats-icon" style="background: linear-gradient(135deg, #17a2b8, #20c9e0);">
                        <i class="fas fa-comments"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card" style="border-left-color: #ffc107;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stats-label">Total Users</div>
                        <div class="stats-number">{{ $stats['total_users'] }}</div>
                    </div>
                    <div class="stats-icon" style="background: linear-gradient(135deg, #ffc107, #ffcd39);">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-history me-2"></i>Riwayat Chat Terbaru</span>
                    <a href="{{ route('admin.chat-history.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Waktu</th>
                                    <th>User</th>
                                    <th>Pertanyaan</th>
                                    {{-- <th>Confidence</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentChats as $chat)
                                    <tr>
                                        <td class="text-nowrap">
                                            <small>{{ $chat->created_at->format('d/m/Y H:i') }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                {{ $chat->user ? $chat->user->name : 'Guest' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div
                                                style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                {{ $chat->question }}
                                            </div>
                                        </td>
                                        {{-- <td>
                                            @if ($chat->confidence_score > 70)
                                                <span
                                                    class="badge bg-success">{{ number_format($chat->confidence_score, 0) }}%</span>
                                            @elseif($chat->confidence_score > 40)
                                                <span
                                                    class="badge bg-warning">{{ number_format($chat->confidence_score, 0) }}%</span>
                                            @else
                                                <span
                                                    class="badge bg-danger">{{ number_format($chat->confidence_score, 0) }}%</span>
                                            @endif
                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                            Belum ada riwayat chat
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-2"></i>Kategori Training Data
                </div>
                <div class="card-body">
                    @forelse($categoryStats as $category)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-capitalize">{{ $category->category }}</span>
                                <strong>{{ $category->total }}</strong>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar"
                                    style="width: {{ ($category->total / $stats['active_training']) * 100 }}%; background: var(--primary);">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                            Belum ada data training
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <i class="fas fa-tools me-2"></i>Quick Actions
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.training-data.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Training Data
                        </a>
                        <a href="{{ route('admin.training-data.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-database me-2"></i>Kelola Training Data
                        </a>
                        <a href="{{ route('admin.chat-history.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-history me-2"></i>Lihat Riwayat Chat
                        </a>
                        <a href="{{ route('chatbot.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-comments me-2"></i>Test Chatbot
                        </a>
                    </div>
                </div>
            </div>

            {{-- <div class="card mt-4">
                <div class="card-header">
                    <i class="fas fa-info-circle me-2"></i>Informasi Sistem
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted d-block">Algoritma Matching</small>
                        <strong>Advanced NLP + Keyword Matching</strong>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block">Minimum Confidence</small>
                        <strong>30%</strong>
                    </div>
                    <div>
                        <small class="text-muted d-block">Last Updated</small>
                        <strong>{{ now()->format('d M Y, H:i') }}</strong>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
