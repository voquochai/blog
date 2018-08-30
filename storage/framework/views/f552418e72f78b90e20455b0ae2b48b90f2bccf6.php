
<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="header-title">Chỉnh sửa</h4>
    		</div>
            <div class="card-body">
                <form method="post" action="<?php echo e(route('admin.users.update', ['id'=>$item->id, 'type'=>$type])); ?>" class="form-validation" novalidate="">
                    <?php echo method_field('PUT'); ?>
                    <?php echo csrf_field(); ?>
                    <div class="form-group mb-3">
                        <label>Họ và tên</label>
                        <input type="text" name="name" class="form-control validate[required]" placeholder="Họ và tên" value="<?php echo e($item->name); ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control validate[required,custom[email]]" placeholder="Email" value="<?php echo e($item->email); ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label>Mật khẩu</label>
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu" value="">
                    </div>
                    <div class="form-group mb-3">
                        <label>Thứ tự</label>
                        <input type="number" name="priority" class="form-control" value="<?php echo e($item->priority); ?>" min="1" max="9999" placeholder="Thứ tự" disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label">Tình trạng</label>
                        <?php $__empty_1 = true; $__currentLoopData = $config['status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="custom-control custom-control-inline custom-checkbox ml-2">
                            <input type="checkbox" name="status[]" value="<?php echo e($k); ?>" <?php echo e(strpos($item->status,$k) !== false ? 'checked' : ''); ?> class="custom-control-input" id="customCheck<?php echo e($k); ?>">
                            <label class="custom-control-label" for="customCheck<?php echo e($k); ?>"><?php echo e($v); ?></label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>

                    </div>
                    <button type="submit" class="btn btn-primary"> <i class="mdi mdi-check"></i> Lưu</button>
                    <a href="<?php echo e(route('admin.users.index', ['type'=>$type])); ?>" class="btn btn-danger" > <i class="mdi mdi-login-variant"></i> Thoát</a>
                </form>

            </div> <!-- end card body-->
        </div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>