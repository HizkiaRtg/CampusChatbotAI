<?php $__env->startSection('title', 'Training Data - Admin'); ?>
<?php $__env->startSection('page-title', 'Manajemen Training Data'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="fas fa-database me-2"></i>Training Data</span>
            <a href="<?php echo e(route('admin.training-data.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Data Baru
            </a>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('admin.training-data.index')); ?>" method="GET" class="row g-3 mb-4">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari pertanyaan/jawaban..."
                        value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="">Semua Kategori</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat); ?>" <?php echo e(request('category') == $cat ? 'selected' : ''); ?>>
                                <?php echo e(ucfirst($cat)); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="1" <?php echo e(request('status') == '1' ? 'selected' : ''); ?>>Aktif</option>
                        <option value="0" <?php echo e(request('status') == '0' ? 'selected' : ''); ?>>Nonaktif</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="<?php echo e(route('admin.training-data.index')); ?>" class="btn btn-secondary">
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
                        <?php $__empty_1 = true; $__currentLoopData = $trainingData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($trainingData->firstItem() + $loop->index); ?></td>
                                <td>
                                    <strong><?php echo e(Str::limit($data->question, 60)); ?></strong>
                                </td>
                                <td>
                                    <small class="text-muted"><?php echo e(Str::limit($data->answer, 80)); ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-info"><?php echo e($data->category); ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary"><?php echo e($data->priority); ?></span>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" type="checkbox"
                                            data-id="<?php echo e($data->id); ?>" <?php echo e($data->is_active ? 'checked' : ''); ?>>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?php echo e(route('admin.keywords.index', $data->id)); ?>" class="btn btn-info"
                                            title="Kelola Keywords">
                                            <i class="fas fa-tags"></i>
                                        </a>
                                        <a href="<?php echo e(route('admin.training-data.edit', $data->id)); ?>"
                                            class="btn btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger" onclick="confirmDelete(<?php echo e($data->id); ?>)"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <form id="delete-form-<?php echo e($data->id); ?>"
                                        action="<?php echo e(route('admin.training-data.destroy', $data->id)); ?>" method="POST"
                                        class="d-none">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                    <p class="text-muted">Belum ada training data</p>
                                    <a href="<?php echo e(route('admin.training-data.create')); ?>" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Tambah Data Pertama
                                    </a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($trainingData->hasPages()): ?>
                <div class="mt-4">
                    <?php echo e($trainingData->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\LARAVEL\CampusChatbot\resources\views/admin/training-data/index.blade.php ENDPATH**/ ?>