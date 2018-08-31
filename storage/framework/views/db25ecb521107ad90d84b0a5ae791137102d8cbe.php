<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
                <div class="card-widgets">
                    <a href="<?php echo e(route('admin.categories.create', ['type'=>$type])); ?>" class="btn btn-primary mr-2"> <i class="mdi mdi-plus"></i> Tạo mới</a>
                    <div class="dropdown">
	                    <a href="javascript:void(0);" class="btn btn-outline-primary rounded-circle dropdown-toggle arrow-none" data-toggle="dropdown" aria-expanded="false">
	                        <i class="dripicons-dots-3"></i>
	                    </a>
	                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                            <?php $__empty_1 = true; $__currentLoopData = $config['status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <a href="javascript:;" class="dropdown-item" onclick="$.MyTools.changeMultiStatus('<?php echo e($k); ?>', event)"><i class="mdi mdi-circle-edit-outline mr-1"></i><?php echo e($v); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <?php endif; ?>
	                        <a href="javascript:;" class="dropdown-item" onclick="$.MyTools.deleteMultiRows(event)"><i class="mdi mdi-delete mr-1"></i>Xóa chọn</a>
	                    </div>
	                </div>
                </div>
				<h4 class="header-title">Danh sách</h4>
    		</div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-centered">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 1%;">
                                    <div class="custom-control custom-checkbox custom-checkbox-all custom-checkbox-single">
                                        <input type="checkbox" name="" class="custom-control-input" id="customCheckAll" data-group="all">
                                        <label class="custom-control-label" for="customCheckAll"></label>
                                    </div>
                                </th>
                                <th style="width: 5%;">#</th>
                                <th>Tiêu đề</th>
                                <th>Ngày tạo</th>
                                <th>Tình trạng</th>
                                <th>Thực thi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $traverse = function ($categories, $prefix = '') use (&$traverse, $config, $type) {

                                    foreach ($categories as $category) {
                            ?>
                                <tr <?php echo $prefix == '' ? 'class="table-light"' : ''; ?> >
                                    <td>
                                        <div class="custom-control custom-checkbox custom-checkbox-single">
                                            <input type="checkbox" name="checkAction[]" value="<?php echo e($category->id); ?>" class="custom-control-input" id="customCheck<?php echo e($category->id); ?>" data-group="all">
                                            <label class="custom-control-label" for="customCheck<?php echo e($category->id); ?>"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="priority" value="<?php echo e($category->priority); ?>" class="form-control form-control-sm form-control-light" onchange="$.MyTools.updatePriority(<?php echo e($category->id); ?>, this.value, event)" />
                                    </td>
                                    <td><a href="<?php echo e(route('admin.categories.edit', ['id'=>$category->id, 'type'=>$type])); ?>"><?php echo e($prefix.' '.$category->name); ?></a></td>
                                    <td><?php echo e($category->created_at); ?></td>
                                    <td>
                                        <?php foreach($config['status'] as $k => $v){ ?>
                                        <button type="button" class="btn btn-sm btn-<?php echo e(strpos($category->status,$k) !== false ? 'info' : 'secondary'); ?> btn-status-<?php echo e($k); ?>" onclick="$.MyTools.changeStatus(<?php echo e($category->id); ?>, '<?php echo e($k); ?>', event)"> <?php echo e($v); ?> </button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.categories.edit', ['id'=>$category->id, 'type'=>$type])); ?>" class="btn btn-sm btn-primary">
                                            <i class="mdi mdi-circle-edit-outline"></i>
                                        </a>
                                        <a href="javascript:;" class="btn btn-sm btn-danger" onclick="$.MyTools.deleteRow(<?php echo e($category->id); ?>, event)" >
                                            <i class="mdi mdi-close"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                        $traverse($category->children, $prefix.'-');
                                    }
                                };
                                $traverse($categories);
                            ?>
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div> <!-- end card body-->
        </div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>