@extends('layouts.admin')

@section('title', 'Riwayat Chat - Admin')
@section('page-title', 'Riwayat Chat')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="fas fa-history me-2"></i>Riwayat Chat</span>
            <form action="{{ route('admin.chat-history.clear') }}" method="POST"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus SEMUA riwayat chat?')">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash me-2"></i>Hapus Semua
                </button>
            </form>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.chat-history.index') }}" method="GET" class="row g-3 mb-4">
                <div class="col-md-9">
                    <input type="text" name="search" class="form-control" placeholder="Cari pertanyaan/jawaban..."
                        value="{{ request('search') }}">
                </div>
                {{-- <div class="col-md-2">
                    <input type="number" name="min_confidence" class="form-control" placeholder="Min %"
                        value="{{ request('min_confidence') }}" min="0" max="100">
                </div>
                <div class="col-md-2">
                    <input type="number" name="max_confidence" class="form-control" placeholder="Max %"
                        value="{{ request('max_confidence') }}" min="0" max="100">
                </div> --}}
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary me-2 btn-sm">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.chat-history.index') }}" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="10%">Waktu</th>
                            <th width="12%">User</th>
                            <th width="28%">Pertanyaan</th>
                            <th width="35%">Jawaban</th>
                            {{-- <th width="10%">Confidence</th> --}}
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($chatHistories as $chat)
                            <tr>
                                <td class="text-nowrap">
                                    <small>{{ $chat->created_at->format('d/m/Y') }}<br>{{ $chat->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    @if ($chat->user)
                                        <span class="badge bg-secondary">{{ $chat->user->name }}</span>
                                    @else
                                        <span class="badge bg-light text-dark">Guest</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ Str::limit($chat->question, 80) }}</strong>
                                </td>
                                <td>
                                    <small class="text-muted">{{ Str::limit($chat->answer, 120) }}</small>
                                    @if ($chat->trainingData)
                                        <br><span class="badge bg-info mt-1">{{ $chat->trainingData->category }}</span>
                                    @endif
                                </td>
                                {{-- <td>
                                    @if ($chat->confidence_score > 70)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle"></i>
                                            {{ number_format($chat->confidence_score, 0) }}%
                                        </span>
                                    @elseif($chat->confidence_score > 40)
                                        <span class="badge bg-warning">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            {{ number_format($chat->confidence_score, 0) }}%
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times-circle"></i>
                                            {{ number_format($chat->confidence_score, 0) }}%
                                        </span>
                                    @endif
                                </td> --}}
                                <td>
                                    <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $chat->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $chat->id }}"
                                        action="{{ route('admin.chat-history.destroy', $chat->id) }}" method="POST"
                                        class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                    <p class="text-muted">Belum ada riwayat chat</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($chatHistories->hasPages())
                <div class="mt-4">
                    {{ $chatHistories->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                    <h4 class="mb-1">{{ $chatHistories->where('confidence_score', '>', 70)->count() }}</h4>
                    <small class="text-muted">Confidence Tinggi (>70%)</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning mb-2"></i>
                    <h4 class="mb-1">
                        {{ $chatHistories->where('confidence_score', '>', 40)->where('confidence_score', '<=', 70)->count() }}
                    </h4>
                    <small class="text-muted">Confidence Sedang (40-70%)</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-times-circle fa-2x text-danger mb-2"></i>
                    <h4 class="mb-1">{{ $chatHistories->where('confidence_score', '<=', 40)->count() }}</h4>
                    <small class="text-muted">Confidence Rendah (≤40%)</small>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@push('scripts')
    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus riwayat chat ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endpush
