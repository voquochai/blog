
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">Thêm mới</h4>
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo e(route('admin.users.store', ['type'=>$type])); ?>" class="form-validation" novalidate="">
                    <?php echo csrf_field(); ?>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-12">Họ và tên</label>
                        <div class="col-lg-10 col-12">
                            <input type="text" name="name" class="form-control validate[required]" placeholder="Họ và tên" value="<?php echo e(old('name')); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-12">Email</label>
                        <div class="col-lg-10 col-12">
                            <input type="email" name="email" class="form-control validate[required,custom[email]]" placeholder="Email" value="<?php echo e(old('email')); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-12">Mật khẩu</label>
                        <div class="col-lg-10 col-12">
                            <input type="password" name="password" class="form-control validate[required,minSize[6]]" placeholder="Mật khẩu" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-12">Thứ tự</label>
                        <div class="col-lg-auto col-12">
                            <input type="number" name="priority" class="form-control" value="<?php echo e($priority+1); ?>" placeholder="Thứ tự" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-auto">Tình trạng</label>
                        <div class="col-lg-10 col">
                        <?php $__empty_1 = true; $__currentLoopData = $config['status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="custom-control custom-control-inline custom-checkbox">
                                <input type="checkbox" name="status[]" value="<?php echo e($k); ?>" <?php echo e(old('status') ? in_array($k,old('status')) ? 'checked' : '' : $k == 'publish' ? 'checked' : ''); ?> class="custom-control-input" id="customCheck<?php echo e($k); ?>">
                                <label class="custom-control-label" for="customCheck<?php echo e($k); ?>"><?php echo e($v); ?></label>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"> <i class="mdi mdi-check"></i> Lưu</button>
                    <a href="<?php echo e(route('admin.users.index', ['type'=>$type])); ?>" class="btn btn-danger" > <i class="mdi mdi-login-variant"></i> Thoát</a>
                </form>

            </div> <!-- end card body-->
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>