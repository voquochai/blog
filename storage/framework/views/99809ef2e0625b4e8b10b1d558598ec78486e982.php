<!DOCTYPE html>
    <html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title>Administrator</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="" rel="shortcut icon">
        <link href="<?php echo e(asset('public/packages/bootstrap/css/bootstrap.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/backend/css/app.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/backend/css/responsive.css')); ?>" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <h4 class="card-header"><?php echo e(__('Login')); ?></h4>
                        <div class="card-body">
                            <form method="POST" action="<?php echo e(route('admin.login')); ?>" aria-label="<?php echo e(__('Login')); ?>">
                                <?php echo csrf_field(); ?>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                                        <?php if($errors->has('email')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('email')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>

                                        <?php if($errors->has('password')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('password')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                            <label class="custom-control-label" for="remember">
                                                <?php echo e(__('Remember Me')); ?>

                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            <?php echo e(__('Login')); ?>

                                        </button>

                                        <a class="btn btn-link" href="<?php echo e(route('admin.password.request')); ?>">
                                            <?php echo e(__('Forgot Your Password?')); ?>

                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo e(asset('public/packages/jquery.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/packages/bootstrap/js/bootstrap.bundle.min.js')); ?>" type="text/javascript"></script>
    </body>
</html>