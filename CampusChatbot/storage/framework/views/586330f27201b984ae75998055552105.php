<?php $__env->startSection('title', 'Login - Campus Chatbot'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header text-center">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </div>
                    <div class="card-body p-4">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i><?php echo e($errors->first()); ?>

                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('login')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>"
                                        required autofocus>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Ingat Saya</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>

                            <div class="text-center">
                                <span class="text-muted">Belum punya akun?</span>
                                <a href="<?php echo e(route('register')); ?>" class="text-decoration-none">Daftar Sekarang</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4 text-muted small">
                    <p><strong>Demo Akun:</strong></p>
                    <p>Admin: admin@campus.ac.id | User: user@campus.ac.id<br>Password: password123</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .input-group-text {
            background: var(--primary-glow);
            border: 1px solid #dee2e6;
            color: var(--primary);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem var(--primary-glow);
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\LARAVEL\CampusChatbot\resources\views/auth/login.blade.php ENDPATH**/ ?>