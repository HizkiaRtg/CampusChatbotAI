

<?php $__env->startSection('title', 'Job Application Details'); ?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('job-applications.index')); ?>" class="text-decoration-none">
                            <i class="fas fa-briefcase me-1"></i>Job Applications
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Application Details</li>
                </ol>
            </nav>
            <h1 class="h3 mb-0">
                <i class="fas fa-user me-2"></i>
                <?php echo e($jobApplication->name); ?>

            </h1>
            <p class="text-muted mb-0">Applied for <?php echo e($jobApplication->job_available); ?></p>
        </div>

        <div class="d-flex gap-2">
            <a href="<?php echo e(route('job-applications.index')); ?>" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to List
            </a>

            <?php if($jobApplication->cv_path): ?>
                <a href="<?php echo e(route('job-applications.download-cv', $jobApplication)); ?>" class="btn btn-success">
                    <i class="fas fa-download me-1"></i>Download CV
                </a>
            <?php endif; ?>

            <button type="button" class="btn btn-danger" onclick="confirmDelete(<?php echo e($jobApplication->id); ?>)">
                <i class="fas fa-trash me-1"></i>Delete
            </button>
        </div>
    </div>

    <div class="row">
        <!-- Personal Information -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-user-circle me-2"></i>
                        Personal Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Full Name</label>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width: 50px; height: 50px; font-size: 20px;">
                                        <?php echo e(strtoupper(substr($jobApplication->name, 0, 1))); ?>

                                    </div>
                                    <div>
                                        <h5 class="mb-0"><?php echo e($jobApplication->name); ?></h5>
                                        <small class="text-muted">Applicant</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Email Address</label>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-envelope text-primary me-2"></i>
                                    <a href="mailto:<?php echo e($jobApplication->email); ?>" class="text-decoration-none">
                                        <?php echo e($jobApplication->email); ?>

                                    </a>
                                    <button class="btn btn-sm btn-outline-primary ms-2"
                                        onclick="copyToClipboard('<?php echo e($jobApplication->email); ?>')" title="Copy email">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Phone Number</label>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-phone text-success me-2"></i>
                                    <a href="tel:<?php echo e($jobApplication->phone); ?>" class="text-decoration-none">
                                        <?php echo e($jobApplication->phone); ?>

                                    </a>
                                    <button class="btn btn-sm btn-outline-success ms-2"
                                        onclick="copyToClipboard('<?php echo e($jobApplication->phone); ?>')" title="Copy phone">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Telegram Username</label>
                                <div class="d-flex align-items-center">
                                    <i class="fab fa-telegram text-info me-2"></i>

                                    <?php
                                        $telUsername = ltrim($jobApplication->telegram_username, '@'); // remove leading '@' if present
                                    ?>

                                    <a href="https://t.me/<?php echo e($telUsername); ?>" target="_blank"
                                        class="text-decoration-none">
                                        <?php echo e($telUsername); ?>

                                    </a>

                                    <button class="btn btn-sm btn-outline-info ms-2"
                                        onclick="copyToClipboard('<?php echo e($jobApplication->telegram_username); ?>')"
                                        title="Copy username">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Details & Summary -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-briefcase me-2"></i>
                        Job Application Details
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label text-muted">Applied Position</label>
                                <div>
                                    <span class="btn bg-info fs-6 px-3 py-2">
                                        <i class="fas fa-code me-1"></i>
                                        <?php echo e($jobApplication->job_available); ?>

                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label text-muted">Application Source</label>
                                <div>
                                    <span class="btn bg-secondary fs-6 px-3 py-2">
                                        <i class="fas fa-globe me-1"></i>
                                        <?php echo e($jobApplication->app_name); ?>

                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label text-muted">Current Status</label>
                                <div>
                                    <?php
                                        $statusData = $statusOptions[$jobApplication->status] ?? [
                                            'label' => ucfirst($jobApplication->status),
                                            'color' => 'secondary',
                                            'emoji' => '❓',
                                        ];
                                    ?>
                                    <div class="dropdown">
                                        <button class="btn btn-<?php echo e($statusData['color']); ?> dropdown-toggle status-btn"
                                            type="button" id="statusDropdown" data-bs-toggle="dropdown"
                                            aria-expanded="false" data-application-id="<?php echo e($jobApplication->id); ?>">
                                            <?php echo e($statusData['emoji']); ?> <?php echo e($statusData['label']); ?>

                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                                            <?php $__currentLoopData = $statusOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statusKey => $statusOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <a class="dropdown-item status-option <?php echo e($jobApplication->status == $statusKey ? 'active' : ''); ?>"
                                                        href="#" data-status="<?php echo e($statusKey); ?>"
                                                        data-application-id="<?php echo e($jobApplication->id); ?>">
                                                        <?php echo e($statusOption['emoji']); ?> <?php echo e($statusOption['label']); ?>

                                                    </a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Summary / Cover Letter</label>
                        <div class="bg-light p-3 rounded border">
                            <div class="summary-content">
                                <?php echo nl2br(e($jobApplication->summary)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CV Section -->
            <?php if($jobApplication->cv_path): ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-file-pdf me-2"></i>
                            Curriculum Vitae
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded border">
                            <div class="d-flex align-items-center">
                                <div class="file-icon bg-danger text-white rounded d-flex align-items-center justify-content-center me-3"
                                    style="width: 50px; height: 50px;">
                                    <i class="fas fa-file-pdf fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">
                                        <?php echo e($jobApplication->name); ?>_CV.<?php echo e(pathinfo($jobApplication->cv_path, PATHINFO_EXTENSION)); ?>

                                    </h6>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        Uploaded: <?php echo e($jobApplication->created_at->format('M d, Y H:i A')); ?>

                                    </small>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <a href="<?php echo e(asset($jobApplication->cv_path)); ?>" target="_blank"
                                    class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>View
                                </a>
                                <a href="<?php echo e(route('job-applications.download-cv', $jobApplication)); ?>"
                                    class="btn btn-success btn-sm">
                                    <i class="fas fa-download me-1"></i>Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Application Status -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Application Status
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted">Status:</span>
                        <span class="badge bg-<?php echo e($statusData['color']); ?> fs-6">
                            <?php echo e($statusData['emoji']); ?> <?php echo e($statusData['label']); ?>

                        </span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted">Applied:</span>
                        <span><?php echo e($jobApplication->created_at->format('M d, Y')); ?></span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted">Time:</span>
                        <span><?php echo e($jobApplication->created_at->format('H:i A')); ?></span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted">Days Ago:</span>
                        <span><?php echo e($jobApplication->created_at->diffForHumans()); ?></span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <span class="text-muted">Last Updated:</span>
                        <span><?php echo e($jobApplication->updated_at->format('M d, Y H:i')); ?></span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>
                        Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="mailto:<?php echo e($jobApplication->email); ?>?subject=Re: Job Application - <?php echo e($jobApplication->job_available); ?>"
                            class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-envelope me-2"></i>Send Email
                        </a>

                        <a href="https://t.me/<?php echo e($jobApplication->telegram_username); ?>" target="_blank"
                            class="btn btn-outline-info btn-sm">
                            <i class="fab fa-telegram me-2"></i>Contact via Telegram
                        </a>

                        <a href="tel:<?php echo e($jobApplication->phone); ?>" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-phone me-2"></i>Call Phone
                        </a>

                        <?php if($jobApplication->cv_path): ?>
                            <a href="<?php echo e(route('job-applications.download-cv', $jobApplication)); ?>"
                                class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-download me-2"></i>Download CV
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                        <h5>Are you sure?</h5>
                        <p class="text-muted">
                            You are about to delete the job application from <strong><?php echo e($jobApplication->name); ?></strong>.
                            This action cannot be undone and will also delete the associated CV file.
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <form id="deleteForm" method="POST"
                        action="<?php echo e(route('job-applications.destroy', $jobApplication)); ?>" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>Delete Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Copy Success Toast -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="copyToast" class="toast" role="alert">
            <div class="toast-header">
                <i class="fas fa-check-circle text-success me-2"></i>
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                Copied to clipboard!
            </div>
        </div>
    </div>

    <!-- Status Update Toast -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1060;">
        <div id="statusUpdateToast" class="toast" role="alert">
            <div class="toast-header">
                <i class="fas fa-check-circle text-success me-2"></i>
                <strong class="me-auto">Status Updated</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body" id="statusUpdateMessage">
                Status updated successfully!
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .summary-content {
            line-height: 1.6;
            max-height: 200px;
            overflow-y: auto;
        }

        .file-icon {
            min-width: 50px;
            min-height: 50px;
        }

        .avatar-circle {
            min-width: 50px;
            min-height: 50px;
        }

        .card-header h5,
        .card-header h6 {
            color: white;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: "›";
            color: #6c757d;
        }

        .dropdown-item.active {
            background-color: #0d6efd;
            color: white;
        }

        .status-btn {
            min-width: 140px;
            text-align: left;
        }

        .dropdown-toggle::after {
            float: right;
            margin-top: 8px;
        }

        .timeline {
            position: relative;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 6px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e9ecef;
        }

        .timeline-item {
            position: relative;
            z-index: 1;
        }

        .timeline-marker {
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        function confirmDelete(applicationId) {
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                const toast = new bootstrap.Toast(document.getElementById('copyToast'));
                toast.show();
            }).catch(function(err) {
                console.error('Could not copy text: ', err);
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = text;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);

                const toast = new bootstrap.Toast(document.getElementById('copyToast'));
                toast.show();
            });
        }

        // Handle status updates
        document.addEventListener('DOMContentLoaded', function() {
            const statusOptions = document.querySelectorAll('.status-option');

            statusOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();

                    const applicationId = this.getAttribute('data-application-id');
                    const newStatus = this.getAttribute('data-status');
                    const statusButton = document.getElementById('statusDropdown');
                    const statusBadge = document.querySelector('.card-body .badge');

                    // Show loading state
                    statusButton.disabled = true;
                    statusButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';

                    // Send AJAX request
                    fetch(`/admin/job-applications/${applicationId}/status`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                status: newStatus
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update dropdown button
                                statusButton.className =
                                    `btn btn-${data.status_color} dropdown-toggle status-btn`;
                                statusButton.innerHTML =
                                    `${data.status_emoji} ${data.status_label}`;
                                statusButton.disabled = false;

                                // Update status badge in sidebar
                                if (statusBadge) {
                                    statusBadge.className =
                                        `badge bg-${data.status_color} fs-6`;
                                    statusBadge.innerHTML =
                                        `${data.status_emoji} ${data.status_label}`;
                                }

                                // Update active state in dropdown
                                document.querySelectorAll('.status-option').forEach(item => {
                                    item.classList.remove('active');
                                    if (item.getAttribute('data-status') ===
                                        newStatus) {
                                        item.classList.add('active');
                                    }
                                });

                                // Show success toast
                                document.getElementById('statusUpdateMessage').textContent =
                                    data.message;
                                const toast = new bootstrap.Toast(document.getElementById(
                                    'statusUpdateToast'));
                                toast.show();
                            } else {
                                // Show error
                                alert('Error updating status: ' + data.message);
                                statusButton.disabled = false;
                                location.reload();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while updating the status.');
                            statusButton.disabled = false;
                            location.reload();
                        });
                });
            });
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\LARAVEL\COMPANYPROFILE\COMPANYPROFILE3\MyAdmin\resources\views/admin/job-applications/show.blade.php ENDPATH**/ ?>