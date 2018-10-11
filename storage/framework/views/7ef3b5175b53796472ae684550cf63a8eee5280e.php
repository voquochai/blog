
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
                                                echo '<option value="'.$category->id.'">'.$prefix.' '.$category->languages[0]->name.'</option>';
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
                                <textarea name="dataL[<?php echo e($key); ?>][contents]" class="form-control tinymce-editor" rows="6" placeholder="Nội dung" ><?php echo e(old('dataL.'.$key.'.contents')); ?></textarea>
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

<?php $__env->startSection('style'); ?>
<link href="<?php echo e(asset('public/packages/file-uploader/fileuploader.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('public/packages/file-uploader/fileuploader.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/packages/tinymce/tinymce.min.js')); ?>" type="text/javascript"></script>
<script>
$(document).ready(function() {
    var saveEditedImage = function(image, item) {
        // set new image
        item.editor._blob = image;
        // if still uploading
        // pend and exit
        if (item.upload && item.upload.status == 'loading')
            return item.editor.isUploadPending = true;
        // if not uploaded
        if (item.upload && item.upload.send && !item.upload.status) {
            item.editor._namee = item.name;
            return item.upload.send();
        }
        // if not preloaded or not uploaded
        if (!item.appended && !item.uploaded)
            return;
        // if no editor
        if (!item.editor || !item.reader.width)
            return;
        // if uploaded
        // resend upload
        if (item.upload && item.upload.resend) {
            item.editor._namee = item.name;
            item.editor._editingg = true;
            item.upload.resend();
        }
        // if preloaded
        // send request
        if (item.appended) {
            // hide current thumbnail (this is only animation)
            item.imageIsUploading = true;
            item.editor._editingg = true;
            var form = new FormData();
            form.append('files[]', item.editor._blob);
            form.append('fileuploader', 1);
            form.append('_namee', item.name);
            form.append('_editingg', true);
            $.ajax({
                url: 'php/ajax_upload_file.php',
                data: form,
                type: 'POST',
                processData: false,
                contentType: false
            });
        }
    };
    $('input[name="image"]').fileuploader({
        limit: 20,
        fileMaxSize: 20,
        extensions: ['jpg', 'jpeg', 'png', 'gif'],
        changeInput: '<div class="fileuploader-input">' +
            '<div class="fileuploader-input-inner">' +
            '<div>${captions.feedback} ${captions.or} <span>${captions.button}</span></div>' +
            '</div>' +
            '</div>',
        theme: 'dropin',
        thumbnails: {
            popup: {
                onShow: function(item) {
                    item.popup.html.on('click', '[data-action="crop"]', function(e) {
                        if (item.editor)
                            item.editor.cropper();
                    }).on('click', '[data-action="rotate-cw"]', function(e) {
                        if (item.editor)
                            item.editor.rotate();
                    }).on('click', '[data-action="remove"]', function(e) {
                        item.popup.close();
                        item.remove();
                    }).on('click', '[data-action="cancel"]', function(e) {
                        item.popup.close();
                    }).on('click', '[data-action="save"]', function(e) {
                        if (item.editor)
                            item.editor.save(function(blob, item) {
                                saveEditedImage(blob, item);
                            }, true, null, false);
                        if (item.popup.close)
                            item.popup.close();
                    });
                },
            },
            onImageLoaded: function(item) {
                if (!item.html.find('.fileuploader-action-edit').length)
                    item.html.find('.fileuploader-action-remove').before('<a class="fileuploader-action fileuploader-action-popup fileuploader-action-edit" title="Edit"><i></i></a>');
                if (item.appended)
                    return;
                // hide current thumbnail (this is only animation)
                if (item.imageIsUploading) {
                    item.image.addClass('fileuploader-loading').html('');
                }
                if (!item.imageLoaded)
                    item.editor.save(function(blob, item) {
                        saveEditedImage(blob, item);
                    }, true, null, true);
                item.imageLoaded = true;
            },
        },
        upload: {
            url: 'php/ajax_upload_file.php',
            data: null,
            type: 'POST',
            enctype: 'multipart/form-data',
            start: false,
            synchron: true,
            beforeSend: function(item, listEl, parentEl, newInputEl, inputEl) {
                // add image to formData
                if (item.editor && item.editor._blob) {
                    item.upload.data.fileuploader = 1;
                    if (item.upload.formData.delete)
                        item.upload.formData.delete(inputEl.attr('name'));
                    item.upload.formData.append(inputEl.attr('name'), item.editor._blob, item.name);
                    // add name to data
                    if (item.editor._namee) {
                        item.upload.data._namee = item.name;
                    }
                    // add is after editing to data
                    if (item.editor._editingg) {
                        item.upload.data._editingg = true;
                    }
                }
                item.html.find('.fileuploader-action-success').removeClass('fileuploader-action-success');
            },
            onSuccess: function(result, item) {
                var data = {};
                try {
                    data = JSON.parse(result);
                } catch (e) {
                    data.hasWarnings = true;
                }
                // if success
                if (data.isSuccess && data.files[0]) {
                    item.name = data.files[0].name;
                    item.html.find('.column-title > div:first-child').text(data.files[0].name).attr('title', data.files[0].name);
                    // send pending editor
                    if (item.editor && item.editor.isUploadPending) {
                        delete item.editor.isUploadPending;
                        saveEditedImage(item.editor._blob, item);
                    }
                }
                // if warnings
                if (data.hasWarnings) {
                    for (var warning in data.warnings) {
                        alert(data.warnings);
                    }
                    item.html.removeClass('upload-successful').addClass('upload-failed');
                    // go out from success function by calling onError function
                    // in this case we have a animation there
                    // you can also response in PHP with 404
                    return this.onError ? this.onError(item) : null;
                }
                item.html.find('.fileuploader-action-remove').addClass('fileuploader-action-success');
                setTimeout(function() {
                    item.html.find('.progress-bar2').fadeOut(400);
                }, 400);
            },
            onError: function(item) {
                var progressBar = item.html.find('.progress-bar2');
                if (progressBar.length) {
                    progressBar.find('span').html(0 + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(0 + "%");
                    item.html.find('.progress-bar2').fadeOut(400);
                }
                item.upload.status != 'cancelled' && item.html.find('.fileuploader-action-retry').length == 0 ? item.html.find('.column-actions').prepend(
                    '<a class="fileuploader-action fileuploader-action-retry" title="Retry"><i></i></a>'
                ) : null;
            },
            onProgress: function(data, item) {
                var progressBar = item.html.find('.progress-bar2');
                if (progressBar.length > 0) {
                    progressBar.show();
                    progressBar.find('span').html(data.percentage + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                }
            },
            onComplete: null,
        },
        editor: {
            cropper: {
                showGrid: true
            },
            maxWidth: 800,
            maxHeight: 600,
            quality: 98
        },
        onRemove: function(item) {
            $.post('./php/ajax_remove_file.php', {
                file: item.name
            });
        },
        captions: {
            feedback: 'Drag and drop files here',
            or: 'or',
            button: 'Browse Files'
        }
    });
});

tinymce.init({
    selector: '.tinymce-editor',
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', 'postAcceptor.php');
        xhr.onload = function() {
          var json;

          if (xhr.status != 200) {
            failure('HTTP Error: ' + xhr.status);
            return;
          }
          json = JSON.parse(xhr.responseText);

          if (!json || typeof json.location != 'string') {
            failure('Invalid JSON: ' + xhr.responseText);
            return;
          }
          success(json.location);
        };
        formData = new FormData();
        formData.append('file', blobInfo.blob(), fileName(blobInfo));
        xhr.send(formData);
    },
    height: 500,
    menubar: false,
    plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help wordcount'
    ],
    toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>