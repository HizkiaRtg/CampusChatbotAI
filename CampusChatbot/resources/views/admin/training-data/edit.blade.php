@extends('layouts.admin')

@section('title', 'Edit Training Data - Admin')
@section('page-title', 'Edit Training Data')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-edit me-2"></i>Form Edit Training Data
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.training-data.update', $trainingData->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Pertanyaan <span class="text-danger">*</span></label>
                            <input type="text" name="question" class="form-control"
                                value="{{ old('question', $trainingData->question) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jawaban <span class="text-danger">*</span></label>
                            <textarea name="answer" class="form-control" rows="6" required>{{ old('answer', $trainingData->answer) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <input type="text" name="category" class="form-control"
                                        value="{{ old('category', $trainingData->category) }}" list="categoryList" required>
                                    <datalist id="categoryList">
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat }}">
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority (0-10) <span class="text-danger">*</span></label>
                                    <input type="number" name="priority" class="form-control"
                                        value="{{ old('priority', $trainingData->priority) }}" min="0" max="10"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                    {{ old('is_active', $trainingData->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Aktifkan data ini
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update
                            </button>
                            <a href="{{ route('admin.keywords.index', $trainingData->id) }}" class="btn btn-info">
                                <i class="fas fa-tags me-2"></i>Kelola Keywords
                            </a>
                            <a href="{{ route('admin.training-data.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <i class="fas fa-info-circle me-2"></i>Informasi Data
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted d-block">Dibuat</small>
                            <strong>{{ $trainingData->created_at->format('d M Y, H:i') }}</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Terakhir Update</small>
                            <strong>{{ $trainingData->updated_at->format('d M Y, H:i') }}</strong>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted d-block">Jumlah Keywords</small>
                        <strong>{{ $trainingData->keywords->count() }} keywords</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
