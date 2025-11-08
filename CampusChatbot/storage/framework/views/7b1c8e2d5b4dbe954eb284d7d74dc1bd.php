<?php $__env->startSection('title', 'Riwayat Chat - Admin'); ?>
<?php $__env->startSection('page-title', 'Riwayat Chat'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="fas fa-history me-2"></i>Riwayat Chat</span>
            <form action="<?php echo e(route('admin.chat-history.clear')); ?>" method="POST"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus SEMUA riwayat chat?')">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash me-2"></i>Hapus Semua
                </button>
            </form>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('admin.chat-history.index')); ?>" method="GET" class="row g-3 mb-4">
                <div class="col-md-9">
                    <input type="text" name="search" class="form-control" placeholder="Cari pertanyaan/jawaban..."
                        value="<?php echo e(request('search')); ?>">
                </div>
                
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary me-2 btn-sm">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="<?php echo e(route('admin.chat-history.index')); ?>" class="btn btn-secondary">
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
                            
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $chatHistories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="text-nowrap">
                                    <small><?php echo e($chat->created_at->format('d/m/Y')); ?><br><?php echo e($chat->created_at->format('H:i')); ?></small>
                                </td>
                                <td>
                                    <?php if($chat->user): ?>
                                        <span class="badge bg-secondary"><?php echo e($chat->user->name); ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-light text-dark">Guest</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong><?php echo e(Str::limit($chat->question, 80)); ?></strong>
                                </td>
                                <td>
                                    <small class="text-muted"><?php echo e(Str::limit($chat->answer, 120)); ?></small>
                                    <?php if($chat->trainingData): ?>
                                        <br><span class="badge bg-info mt-1"><?php echo e($chat->trainingData->category); ?></span>
                                    <?php endif; ?>
                                </td>
                                
                                <td>
                                    <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?php echo e($chat->id); ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <form id="delete-form-<?php echo e($chat->id); ?>"
                                        action="<?php echo e(route('admin.chat-history.destroy', $chat->id)); ?>" method="POST"
                                        class="d-none">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                    <p class="text-muted">Belum ada riwayat chat</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($chatHistories->hasPages()): ?>
                <div class="mt-4">
                    <?php echo e($chatHistories->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>

    
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus riwayat chat ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\LARAVEL\CampusChatbot\resources\views/admin/chat-history/index.blade.php ENDPATH**/ ?>