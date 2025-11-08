@extends('layouts.admin')

@section('title', 'Training Data - Admin')
@section('page-title', 'Manajemen Training Data')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="fas fa-database me-2"></i>Training Data</span>
            <a href="{{ route('admin.training-data.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Data Baru
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.training-data.index') }}" method="GET" class="row g-3 mb-4">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari pertanyaan/jawaban..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                {{ ucfirst($cat) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.training-data.index') }}" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th width="25%">Pertanyaan</th>
                            <th width="30%">Jawaban</th>
                            <th width="10%">Kategori</th>
                            <th width="8%">Priority</th>
                            <th width="8%">Status</th>
                            <th width="14%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($trainingData as $data)
                            <tr>
                                <td>{{ $trainingData->firstItem() + $loop->index }}</td>
                                <td>
                                    <strong>{{ Str::limit($data->question, 60) }}</strong>
                                </td>
                                <td>
                                    <small class="text-muted">{{ Str::limit($data->answer, 80) }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $data->category }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $data->priority }}</span>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" type="checkbox"
                                            data-id="{{ $data->id }}" {{ $data->is_active ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.keywords.index', $data->id) }}" class="btn btn-info"
                                            title="Kelola Keywords">
                                            <i class="fas fa-tags"></i>
                                        </a>
                                        <a href="{{ route('admin.training-data.edit', $data->id) }}"
                                            class="btn btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger" onclick="confirmDelete({{ $data->id }})"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $data->id }}"
                                        action="{{ route('admin.training-data.destroy', $data->id) }}" method="POST"
                                        class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                    <p class="text-muted">Belum ada training data</p>
                                    <a href="{{ route('admin.training-data.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Tambah Data Pertama
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($trainingData->hasPages())
                <div class="mt-4">
                    {{ $trainingData->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.status-toggle').forEach(toggle => {
            toggle.addEventListener('change', async function() {
                const id = this.dataset.id;
                const isActive = this.checked;

                try {
                    const response = await fetch(`/admin/training-data/${id}/toggle`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const data = await response.json();

                    if (!data.success) {
                        this.checked = !isActive;
                        alert('Gagal mengubah status');
                    }
                } catch (error) {
                    this.checked = !isActive;
                    alert('Terjadi kesalahan');
                }
            });
        });

        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endpush
