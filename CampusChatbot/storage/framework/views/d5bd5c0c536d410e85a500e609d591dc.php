<?php $__env->startSection('title', 'Kelola Keywords - Admin'); ?>
<?php $__env->startSection('page-title', 'Kelola Keywords'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-tags me-2"></i>Keywords untuk: <strong>"<?php echo e($trainingData->question); ?>"</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="10%">#</th>
                                    <th width="60%">Keyword</th>
                                    <th width="20%">Weight</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><strong><?php echo e($keyword->keyword); ?></strong></td>
                                        <td>
                                            <span class="badge bg-primary"><?php echo e($keyword->weight); ?>x</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger"
                                                onclick="confirmDelete(<?php echo e($keyword->id); ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <form id="delete-form-<?php echo e($keyword->id); ?>"
                                                action="<?php echo e(route('admin.keywords.destroy', $keyword->id)); ?>" method="POST"
                                                class="d-none">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                            Belum ada keywords
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <a href="<?php echo e(route('admin.training-data.edit', $trainingData->id)); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Edit Data
                </a>
                <a href="<?php echo e(route('admin.training-data.index')); ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-list me-2"></i>Ke Daftar Data
                </a>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-plus me-2"></i>Tambah Keyword Baru
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

                    <form action="<?php echo e(route('admin.keywords.store', $trainingData->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label class="form-label">Keyword <span class="text-danger">*</span></label>
                            <input type="text" name="keyword" class="form-control" value="<?php echo e(old('keyword')); ?>" required
                                autofocus>
                            <small class="text-muted">Kata kunci penting dari pertanyaan</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Weight (0.1 - 2.0) <span class="text-danger">*</span></label>
                            <input type="number" name="weight" class="form-control" value="<?php echo e(old('weight', '1.00')); ?>"
                                min="0.1" max="2.0" step="0.1" required>
                            <small class="text-muted">
                                <strong>1.0</strong> = Normal<br>
                                <strong>1.5-2.0</strong> = Sangat penting<br>
                                <strong>0.5-0.9</strong> = Kurang penting
                            </small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-2"></i>Tambah Keyword
                        </button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <i class="fas fa-lightbulb me-2"></i>Tips Keywords
                </div>
                <div class="card-body">
                    <ul class="mb-0 small">
                        <li>Gunakan kata kunci yang <strong>spesifik</strong> dan <strong>unik</strong></li>
                        <li>Kata kunci utama: weight <strong>1.5-2.0</strong></li>
                        <li>Kata kunci umum: weight <strong>1.0</strong></li>
                        <li>Kata kunci pelengkap: weight <strong>0.5-0.9</strong></li>
                        <li>Contoh: "senin" (2.0), "jadwal" (1.2), "kuliah" (1.0)</li>
                    </ul>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <i class="fas fa-info-circle me-2"></i>Data Training
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <small class="text-muted d-block">Kategori</small>
                        <span class="badge bg-info"><?php echo e($trainingData->category); ?></span>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted d-block">Priority</small>
                        <span class="badge bg-secondary"><?php echo e($trainingData->priority); ?></span>
                    </div>
                    <div>
                        <small class="text-muted d-block">Status</small>
                        <span class="badge bg-<?php echo e($trainingData->is_active ? 'success' : 'danger'); ?>">
                            <?php echo e($trainingData->is_active ? 'Aktif' : 'Nonaktif'); ?>

                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus keyword ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\LARAVEL\CampusChatbot\resources\views/admin/keywords/index.blade.php ENDPATH**/ ?>