<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
                <h4 class="header-title">Thêm mới</h4>
    		</div>
            <div class="card-body">
                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#general" data-toggle="tab" aria-expanded="false" class="nav-link active"> Thông tin chung </a>
                    </li>
                    <?php $__empty_1 = true; $__currentLoopData = config('siteconfigs.languages'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li class="nav-item">
                        <a href="#language-<?php echo e($key); ?>" data-toggle="tab" aria-expanded="false" class="nav-link"> <?php echo e($val); ?> </a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>
                </ul>
                <form method="post" class="form-validation" action="<?php echo e(route('admin.categories.store', ['type'=>$type])); ?>" novalidate="" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="general">
                            <div class="form-group row mb-3">
                                <label class="col-form-label col-lg-2 col-12">Chọn danh mục</label>
                                <div class="col-lg-10 col-12">
                                    <select name="parent_id" class="selectpicker form-control">
                                        <option value="0"> Danh mục cha </option>
                                        <?php
                                        $traverse = function ($categories, $prefix = '') use (&$traverse, $config, $type) {
                                            foreach ($categories as $category) {
                                                echo '<option value="'.$category->id.'">'.$prefix.' '.$category->name.'</option>';
                                                $traverse($category->children, $prefix.'|--');
                                            }
                                        };
                                        $traverse($categories);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <?php if($config['image']): ?>
                            <div class="form-group row mb-3">
                                <label class="col-form-label col-lg-2 col-12">Hình ảnh</label>
                                <div class="col-lg-10 col-12">
                                    <input type="file" name="image">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-form-label col-lg-2 col-12">Alt</label>
                                <div class="col-lg-10 col-12">
                                    <input type="text" name="data[alt]" class="form-control" value="<?php echo e(old('data.alt')); ?>">
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if($config['icon']): ?>
                            <div class="form-group row mb-3">
                                <label class="col-form-label col-lg-2 col-12">Font Icon</label>
                                <div class="col-lg-10 col-12">
                                    <input type="text" name="data[icon]" class="form-control" value="<?php echo e(old('data.icon')); ?>">
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="form-group row mb-3">
                                <label class="col-form-label col-lg-2 col-12">Thứ tự</label>
                                <div class="col-lg-auto col-12"><input type="number" name="priority" class="form-control" value="<?php echo e($priority+1); ?>" min="1" max="9999" placeholder="Thứ tự" disabled></div>
                            </div>
                            <div class="form-group row mb-3">
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
                        </div>
                        <?php $__empty_1 = true; $__currentLoopData = config('siteconfigs.languages'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="tab-pane" id="language-<?php echo e($key); ?>">
                            <div class="form-group mb-3">
                                <label>Tiêu đề</label>
                                <input type="text" name="dataL[<?php echo e($key); ?>][name]" class="form-control <?php echo e($key==config('siteconfigs.general.language') ? 'validate[required] link-to-slug' : ''); ?>" placeholder="Tiêu đề" value="<?php echo e(old('dataL.'.$key.'.name')); ?>">
                            </div>
                            <?php if( $key==config('siteconfigs.general.language') ): ?>
                            <div class="form-group mb-3">
                                <label>Slug</label>
                                <input type="text" name="dataL[<?php echo e($key); ?>][slug]" class="form-control slug" placeholder="Slug" value="<?php echo e(old('dataL.'.$key.'.slug')); ?>">
                            </div>
                            <?php endif; ?>

                            <?php if($config['description']): ?>
                            <div class="form-group mb-3">
                                <label>Mô tả</label>
                                <textarea name="dataL[<?php echo e($key); ?>][description]" class="form-control" rows="5" placeholder="Mô tả" ><?php echo e(old('dataL.'.$key.'.description')); ?></textarea>
                            </div>
                            <?php endif; ?>

                            <?php if($config['contents']): ?>
                            <div class="form-group mb-3">
                                <label class="control-label">Nội dung</label>
                                <textarea name="dataL[<?php echo e($key); ?>][contents]" class="form-control ck-editor" rows="6" placeholder="Nội dung" ><?php echo e(old('dataL.'.$key.'.contents')); ?></textarea>
                            </div>
                            <?php endif; ?>

                            <?php if($config['meta']): ?>
                            <div class="form-group mb-3">
                                <label>Meta title</label>
                                <input type="text" name="dataL[<?php echo e($key); ?>][meta][title]" class="form-control" placeholder="Meta title" value="<?php echo e(old('dataL.'.$key.'.meta.title')); ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label>Meta keywords</label>
                                <input type="text" name="dataL[<?php echo e($key); ?>][meta][keywords]" class="form-control" placeholder="Meta keywords" value="<?php echo e(old('dataL.'.$key.'.meta.keywords')); ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label>Meta description</label>
                                <textarea type="text" name="dataL[<?php echo e($key); ?>][meta][description]" class="form-control" placeholder="Meta description" rows="5"><?php echo e(old('dataL.'.$key.'.meta.description')); ?></textarea>
                            </div>
                            <?php endif; ?>

                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary"> <i class="mdi mdi-check"></i> Lưu</button>
                        <a href="<?php echo e(route('admin.categories.index', ['type'=>$type])); ?>" class="btn btn-danger" > <i class="mdi mdi-close"></i> Thoát</a>
                    </div>
                </form>
            </div> <!-- end card body-->
        </div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('public/packages/ckeditor/ckeditor.js')); ?>" type="text/javascript"></script>
<script>
var allEditors = document.querySelectorAll('.ck-editor');
for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(allEditors[i]);
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>