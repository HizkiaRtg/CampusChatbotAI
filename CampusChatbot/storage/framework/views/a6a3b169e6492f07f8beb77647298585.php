<?php $__env->startSection('title', 'Edit Training Data - Admin'); ?>
<?php $__env->startSection('page-title', 'Edit Training Data'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-edit me-2"></i>Form Edit Training Data
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

                    <form action="<?php echo e(route('admin.training-data.update', $trainingData->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="mb-3">
                            <label class="form-label">Pertanyaan <span class="text-danger">*</span></label>
                            <input type="text" name="question" class="form-control"
                                value="<?php echo e(old('question', $trainingData->question)); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jawaban <span class="text-danger">*</span></label>
                            <textarea name="answer" class="form-control" rows="6" required><?php echo e(old('answer', $trainingData->answer)); ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <input type="text" name="category" class="form-control"
                                        value="<?php echo e(old('category', $trainingData->category)); ?>" list="categoryList" required>
                                    <datalist id="categoryList">
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($cat); ?>">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </datalist>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority (0-10) <span class="text-danger">*</span></label>
                                    <input type="number" name="priority" class="form-control"
                                        value="<?php echo e(old('priority', $trainingData->priority)); ?>" min="0" max="10"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                    <?php echo e(old('is_active', $trainingData->is_active) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="is_active">
                                    Aktifkan data ini
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update
                            </button>
                            <a href="<?php echo e(route('admin.keywords.index', $trainingData->id)); ?>" class="btn btn-info">
                                <i class="fas fa-tags me-2"></i>Kelola Keywords
                            </a>
                            <a href="<?php echo e(route('admin.training-data.index')); ?>" class="btn btn-secondary">
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
                            <strong><?php echo e($trainingData->created_at->format('d M Y, H:i')); ?></strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Terakhir Update</small>
                            <strong><?php echo e($trainingData->updated_at->format('d M Y, H:i')); ?></strong>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted d-block">Jumlah Keywords</small>
                        <strong><?php echo e($trainingData->keywords->count()); ?> keywords</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\LARAVEL\CampusChatbot\resources\views/admin/training-data/edit.blade.php ENDPATH**/ ?>