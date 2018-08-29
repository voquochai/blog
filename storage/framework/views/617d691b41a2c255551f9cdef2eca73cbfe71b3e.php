
<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
                <div class="card-widgets">
                    <a href="<?php echo e(route('admin.users.create', ['type'=>$type])); ?>" class="btn btn-primary mr-2"> <i class="mdi mdi-plus"></i> Tạo mới</a>
                    <div class="dropdown">
	                    <a href="javascript:void(0);" class="btn btn-outline-primary rounded-circle dropdown-toggle arrow-none" data-toggle="dropdown" aria-expanded="false">
	                        <i class="mdi mdi-dots-horizontal"></i>
	                    </a>
	                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                            <?php $__empty_1 = true; $__currentLoopData = $config['status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <a href="javascript:;" class="dropdown-item" onclick="changeMultiStatus('<?php echo e($k); ?>', event)"><i class="mdi mdi-circle-edit-outline mr-1"></i><?php echo e($v); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <?php endif; ?>
	                        <a href="javascript:;" class="dropdown-item" onclick="deleteMultiRows(event)"><i class="mdi mdi-delete mr-1"></i>Xóa chọn</a>
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
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Ngày đăng ký</th>
                                <th>Tình trạng</th>
                                <th>Thực thi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                            	<td>
                            		<div class="custom-control custom-checkbox custom-checkbox-single">
                                        <input type="checkbox" name="checkAction[]" value="<?php echo e($item->id); ?>" class="custom-control-input" id="customCheck<?php echo e($item->id); ?>" data-group="all">
                                        <label class="custom-control-label" for="customCheck<?php echo e($item->id); ?>"></label>
                                    </div>
                            	</td>
                                <td>
                                    <input type="text" name="priority" value="<?php echo e($item->priority); ?>" class="form-control form-control-sm form-control-light" onchange="updatePriority(<?php echo e($item->id); ?>, this.value, event)" />
                                </td>
                                <td><?php echo e($item->name); ?></td>
                                <td><?php echo e($item->email); ?></td>
                                <td><?php echo e($item->created_at); ?></td>
                                <td>
                                    <?php $__empty_2 = true; $__currentLoopData = $config['status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                    <button type="button" class="btn btn-sm btn-<?php echo e(strpos($item->status,$k) !== false ? 'info' : 'secondary'); ?> btn-status-<?php echo e($k); ?>" onclick="changeStatus(<?php echo e($item->id); ?>, '<?php echo e($k); ?>', event)"> <?php echo e($v); ?> </button>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('admin.users.edit', ['id'=>$item->id, 'type'=>$type])); ?>" class="btn btn-sm btn-primary">
                                        <i class="mdi mdi-circle-edit-outline"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-sm btn-danger" onclick="deleteRow(<?php echo e($item->id); ?>, event)" >
                                        <i class="mdi mdi-close"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="30"></td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
                <nav><?php echo $items->appends(['type' => $type])->links('backend.blocks.pagination'); ?></nav>
            </div> <!-- end card body-->
        </div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="text/javascript">
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
    })
    function updatePriority(id,priority,event){
        event.preventDefault();
        var btn = event.target;
        axios.post('<?php echo e(route('admin.users.priority')); ?>',{
            id: id,
            priority: priority
        }).then(res => {
            if(res.data.class === 'success'){
                $(btn).toggleClass('btn-info').toggleClass('btn-secondary');
            }
            $.NotificationApp.send(res.data.head, res.data.message, "top-right", "rgba(0,0,0,0.2)", res.data.class);
        });
    }
    function changeStatus(id,status,event){
        event.preventDefault();
        var btn = event.target;
        axios.post('<?php echo e(route('admin.users.status')); ?>',{
            id: id,
            status: status
        }).then(res => {
            if(res.data.class === 'success'){
                $(btn).toggleClass('btn-info').toggleClass('btn-secondary');
            }
            $.NotificationApp.send(res.data.head, res.data.message, "top-right", "rgba(0,0,0,0.2)", res.data.class);
        });
    }
    function changeMultiStatus(status,event){
        event.preventDefault();
        if( $('input[name="checkAction[]"]').is(':checked') ){
            var ids = $('input[name="checkAction[]"]:checked').map( function () { return this.value; } ).get().join(",");
            axios.post('<?php echo e(route('admin.users.status')); ?>',{
                id: ids,
                status: status
            }).then(res => {
                if(res.data.class === 'success'){
                    $('input[name="checkAction[]"]:checked').map(function () {
                        $(this).closest('tr').find('.btn-status-'+status).toggleClass('btn-info').toggleClass('btn-secondary');
                    });
                }
                $.NotificationApp.send(res.data.head, res.data.message, "top-right", "rgba(0,0,0,0.2)", res.data.class);
            });
        }else{
            $.NotificationApp.send("Cảnh báo!", "Chưa có mục nào được chọn", "top-center", "rgba(0,0,0,0.2)", "warning");
        }
        
    }
    function deleteRow(id,event){
        event.preventDefault();
        var btn = event.target;
        swalWithBootstrapButtons({
            title: 'Xóa dữ liệu?',
            text: "Bạn không thể hoàn nguyên thao tác này!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có, xóa nó!',
            cancelButtonText: 'Không, hủy bỏ!',
            reverseButtons: true
        }).then((res) => {
            if (res.value) {
                axios.delete('users/'+id)
                .then(res => {
                    if(res.data.class === 'success'){
                        $(btn).closest('tr').slideUp('slow', function() {
                            $(this).remove();
                        });
                    }
                    swalWithBootstrapButtons(res.data.head,res.data.message,res.data.class);
                });
            } else if ( res.dismiss === swal.DismissReason.cancel ) {
                swalWithBootstrapButtons('Hủy bỏ','Bạn đã hủy bỏ thao tác này.','error')
            }
        });
    }
    function deleteMultiRows(event){
        event.preventDefault();
        if( $('input[name="checkAction[]"]').is(':checked') ){
            swalWithBootstrapButtons({
                title: 'Xóa dữ liệu?',
                text: "Bạn không thể hoàn nguyên thao tác này!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có, xóa tất cả!',
                cancelButtonText: 'Không, hủy bỏ!',
                reverseButtons: true
            }).then((res) => {
                if (res.value) {
                    $('input[name="checkAction[]"]:checked').map(function () {
                        var id = this.value;
                        axios.delete('users/'+id)
                        .then(res => {
                            if(res.data.class === 'success'){
                                $(this).closest('tr').slideUp('slow', function() {
                                    $(this).remove();
                                });
                            }
                        });
                    });
                    swalWithBootstrapButtons("Thành công!", "Xóa tất cả dữ liệu thành công.", "success");
                } else if ( res.dismiss === swal.DismissReason.cancel ) {
                    swalWithBootstrapButtons('Hủy bỏ','Bạn đã hủy bỏ thao tác này.','error')
                }
            });
        }else{
            $.NotificationApp.send("Cảnh báo!", "Chưa có mục nào được chọn", "top-center", "rgba(0,0,0,0.2)", "warning");
        }
    };
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>