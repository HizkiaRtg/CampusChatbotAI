<?php $__env->startSection('title', 'Tambah Training Data - Admin'); ?>
<?php $__env->startSection('page-title', 'Tambah Training Data'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-plus me-2"></i>Form Training Data Baru
                </div>
                <div class="card-body">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('admin.training-data.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label class="form-label">Pertanyaan <span class="text-danger">*</span></label>
                            <input type="text" name="question" class="form-control" value="<?php echo e(old('question')); ?>"
                                required>
                            <small class="text-muted">Contoh: "jadwal senin apa?" atau "dimana ruang lab komputer?"</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jawaban <span class="text-danger">*</span></label>
                            <textarea name="answer" class="form-control" rows="6" required><?php echo e(old('answer')); ?></textarea>
                            <small class="text-muted">Berikan jawaban yang detail dan informatif</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <input type="text" name="category" class="form-control"
                                        value="<?php echo e(old('category', 'umum')); ?>" list="categoryList" required>
                                    <datalist id="categoryList">
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($cat); ?>">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <option value="jadwal">
                                        <option value="ruangan">
                                        <option value="dosen">
                                        <option value="administrasi">
                                        <option value="fasilitas">
                                        <option value="umum">
                                    </datalist>
                                    <small class="text-muted">Pilih atau ketik kategori baru</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority (0-10) <span class="text-danger">*</span></label>
                                    <input type="number" name="priority" class="form-control"
                                        value="<?php echo e(old('priority', 5)); ?>" min="0" max="10" required>
                                    <small class="text-muted">Semakin tinggi, semakin prioritas saat matching</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
                                <label class="form-check-label" for="is_active">
                                    Aktifkan data ini
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan
                            </button>
                            <a href="<?php echo e(route('admin.training-data.index')); ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <i class="fas fa-lightbulb me-2"></i>Tips Membuat Training Data yang Baik
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li><strong>Pertanyaan:</strong> Gunakan bahasa natural yang umum digunakan mahasiswa</li>
                        <li><strong>Jawaban:</strong> Berikan informasi lengkap, akurat, dan mudah dipahami</li>
                        <li><strong>Kategori:</strong> Kelompokkan berdasarkan topik untuk mempermudah pengelolaan</li>
                        <li><strong>Priority:</strong> Berikan nilai lebih tinggi untuk pertanyaan yang sering ditanyakan
                        </li>
                        <li><strong>Keywords:</strong> Setelah menyimpan, tambahkan keywords untuk meningkatkan akurasi
                            matching</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\LARAVEL\CampusChatbot\resources\views/admin/training-data/create.blade.php ENDPATH**/ ?>