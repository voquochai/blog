<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
                <div class="card-widgets">
                    <a href="<?php echo e(route('admin.categories.create', ['type'=>$type])); ?>" class="btn btn-primary mr-2"> <i class="mdi mdi-plus"></i> Tạo mới</a>
                    <div class="dropdown">
	                    <a href="javascript:void(0);" class="btn btn-outline-primary rounded-circle dropdown-toggle arrow-none" data-toggle="dropdown" aria-expanded="false">
	                        <i class="mdi mdi-dots-horizontal"></i>
	                    </a>
	                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated" x-placement="bottom-end">
                            <?php $__empty_1 = true; $__currentLoopData = $config['status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <a href="javascript:;" class="dropdown-item" onclick="$.Tools.changeMultiStatus('<?php echo e($k); ?>', event)"><i class="mdi mdi-circle-edit-outline mr-1"></i><?php echo e($v); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <?php endif; ?>
	                        <a href="javascript:;" class="dropdown-item" onclick="$.Tools.deleteMultiRows(event)"><i class="mdi mdi-delete mr-1"></i>Xóa chọn</a>
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
                                <th style="width: 1%; text-align: center;">
                                    <div class="custom-control custom-checkbox custom-checkbox-all custom-checkbox-single">
                                        <input type="checkbox" name="" class="custom-control-input" id="customCheckAll" data-group="all">
                                        <label class="custom-control-label" for="customCheckAll"></label>
                                    </div>
                                </th>
                                <th style="width: 1%; text-align: center;">#</th>
                                <th>Tiêu đề</th>
                                <?php if($config['image']): ?>
                                <th> Hình ảnh </th>
                                <?php endif; ?>
                                <th>Ngày tạo</th>
                                <th>Tình trạng</th>
                                <th>Thực thi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $traverse = function ($items, $prefix = '') use (&$traverse, $config, $type, $path) {

                                    foreach ($items as $item) {
                            ?>
                                <tr <?php echo $prefix == '' ? 'class="table-light"' : ''; ?> >
                                    <td>
                                        <div class="custom-control custom-checkbox custom-checkbox-single">
                                            <input type="checkbox" name="checkAction[]" value="<?php echo e($item->id); ?>" class="custom-control-input" id="customCheck<?php echo e($item->id); ?>" data-group="all">
                                            <label class="custom-control-label" for="customCheck<?php echo e($item->id); ?>"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="priority" value="<?php echo e($item->priority); ?>" class="form-control form-control-sm form-control-light" onchange="$.Tools.updatePriority(<?php echo e($item->id); ?>, this.value, event)" />
                                    </td>
                                    <td><a href="<?php echo e(route('admin.categories.edit', ['id'=>$item->id, 'type'=>$type])); ?>"><?php echo e($prefix.' '.$item->languages[0]->name); ?></a></td>
                                    <?php if($config['image']): ?>
                                    <td> <a href="<?php echo e(route('admin.categories.edit', ['id'=>$item->id, 'type'=>$type])); ?>"> <?php echo ($item->image && file_exists(public_path(get_thumbnail($path.'/'.$item->image))) ) ? '<img src="'.asset(get_thumbnail('public/'.$path.'/'.$item->image)).'" height="50" />':''; ?> </a> </td>
                                    <?php endif; ?>
                                    <td><?php echo e($item->created_at); ?></td>
                                    <td>
                                        <?php foreach($config['status'] as $k => $v){ ?>
                                        <button type="button" class="btn btn-sm btn-<?php echo e(strpos($item->status,$k) !== false ? 'info' : 'secondary'); ?> btn-status-<?php echo e($k); ?>" onclick="$.Tools.changeStatus(<?php echo e($item->id); ?>, '<?php echo e($k); ?>', event)"> <?php echo e($v); ?> </button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.categories.edit', ['id'=>$item->id, 'type'=>$type])); ?>" class="btn btn-sm btn-primary">
                                            <i class="mdi mdi-circle-edit-outline"></i>
                                        </a>
                                        <a href="javascript:;" class="btn btn-sm btn-danger" onclick="$.Tools.deleteRow(<?php echo e($item->id); ?>, event)" >
                                            <i class="mdi mdi-close"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                        $traverse($item->children, $prefix.'-');
                                    }
                                };
                                $traverse($items);
                            ?>
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div> <!-- end card body-->
        </div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>