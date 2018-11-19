$(document).ready(function() {
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
    });
    const saveEditedImage = function(image, item) {
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
            // $.ajax({
            //     url: 'php/ajax_upload_file.php',
            //     data: form,
            //     type: 'POST',
            //     processData: false,
            //     contentType: false
            // });
        }
    };

    $('input[data-fileuploader="single"]').fileuploader({
        limit: 1,
        addMore: true,
        extensions: ['jpg', 'jpeg', 'png', 'gif'],
        changeInput: '',
        theme: 'thumbnails',
        enableApi: true,
        thumbnails: {
            box: '<div class="fileuploader-items">' +
                '<ul class="fileuploader-items-list">' +
                '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner"><i>+</i></div></li>' +
                '</ul>' +
                '</div>',
            item: '<li class="fileuploader-item file-has-popup">' +
                '<div class="fileuploader-item-inner">' +
                '<div class="type-holder">${extension}</div>' +
                '<div class="actions-holder">' +
                '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                '</div>' +
                '<div class="thumbnail-holder">' +
                '${image}' +
                '<span class="fileuploader-action-popup"></span>' +
                '</div>' +
                '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                '<div class="progress-holder">${progressBar}</div>' +
                '</div>' +
                '</li>',
            item2: '<li class="fileuploader-item file-has-popup">' +
                '<div class="fileuploader-item-inner">' +
                '<div class="type-holder">${extension}</div>' +
                '<div class="actions-holder">' +
                '<a href="${file}" class="fileuploader-action fileuploader-action-download" title="${captions.download}" download><i></i></a>' +
                '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                '</div>' +
                '<div class="thumbnail-holder">' +
                '${image}' +
                '<span class="fileuploader-action-popup"></span>' +
                '</div>' +
                '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                '<div class="progress-holder">${progressBar}</div>' +
                '</div>' +
                '</li>',
            startImageRenderer: true,
            canvasImage: false,
            removeConfirmation: true,
            _selectors: {
                list: '.fileuploader-items-list',
                item: '.fileuploader-item',
                start: '.fileuploader-action-start',
                retry: '.fileuploader-action-retry',
                remove: '.fileuploader-action-remove'
            },
            onItemShow: function(item, listEl, parentEl, newInputEl, inputEl) {
                var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                    api = $.fileuploader.getInstance(inputEl.get(0));
                plusInput.insertAfter(item.html)[api.getOptions().limit && api.getChoosedFiles().length >= api.getOptions().limit ? 'hide' : 'show']();
                if (item.format == 'image') {
                    item.html.find('.fileuploader-item-icon').hide();
                }
            }
        },
        dragDrop: {
            container: '.fileuploader-thumbnails-input'
        },
        afterRender: function(listEl, parentEl, newInputEl, inputEl) {
            var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                api = $.fileuploader.getInstance(inputEl.get(0));
            plusInput.on('click', function() {
                api.open();
            });
        },
        onRemove: function(item, listEl, parentEl, newInputEl, inputEl) {

            var url = window.location.href.split(/[?#]/)[0];
            url = url.split('/create')[0]; url = url.split('/edit')[0];

            var plusInput = listEl.find('.fileuploader-thumbnails-input'),
            api = $.fileuploader.getInstance(inputEl.get(0));
            if (api.getOptions().limit && api.getChoosedFiles().length - 1 < api.getOptions().limit){
                plusInput.show();
            }

            axios.delete( url + '/remove')
            .then(res => {
            }).catch(error => {
                $.NotificationApp.send(error.response.status, error.response.statusText, "top-right", "rgba(0,0,0,0.2)", 'error');
            });

        },
        editor: {
            cropper: {
                showGrid: true
            },
            maxWidth: 800,
            maxHeight: 600,
            quality: 98
        },
        dialogs: {
            alert: function(text) {
                return alert(text)
            },
            confirm: function(text, callback) {
                confirm(text) ? callback() : null
            }
        },
    });


    $('input[data-fileuploader="multiple"]').fileuploader({
        addMore: true,
        extensions: ['jpg', 'jpeg', 'png', 'gif'],
        changeInput: '<div class="fileuploader-input">' +
            '<div class="fileuploader-input-inner">' +
            '<div>${captions.feedback} ${captions.or} <span>${captions.button}</span></div>' +
            '</div>' +
            '</div>',
        theme: 'dropin',
        thumbnails: {
            box: '<div class="table-responsive-sm">\
                <table class="table table-centered fileuploader-items">\
                    <thead class="thead-light">\
                        <tr>\
                            <th style="width: 5%; text-align: center;"> Thứ tự </th>\
                            <th width="15%"> Hình ảnh </th>\
                            <th width="25%"> Alt </th>\
                            <th width="10%"> Thực thi </th>\
                        </tr>\
                    </thead>\
                    <tbody class="fileuploader-items-list"></tbody>\
                </table>\
            </div>',
            boxAppendTo: $('.fileuploader-table'),
            item: '<tr class="fileuploader-item file-has-popup columns">' +
                '<td>'+
                    '<input type="hidden" name="attachment[name][]" value="${name}">'+
                    '<input type="text" class="form-control form-control-sm form-control-light" name="attachment[priority][]" value="1"></td>' +
                '<td><div class="column-thumbnail">${image}<span class="fileuploader-action-popup"></span></div></td>' +
                '<td><div class="column-title"><input type="text" class="form-control" name="attachment[alt][]" value="${name}"></div></td>' +
                '<td>' +
                    '<div class="column-actions"><a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a></div>' +
                '</td>' +
            '</tr>',
          
            // thumbnails for the preloaded files {String, Function}
            // example: '<li>${name}</li>'
            // example: function(item) { return '<li>' + item.name + '</li>'; }
            item2: '<tr class="fileuploader-item file-has-popup columns">' +
                '<td>'+
                    '<input type="hidden" name="media[id][]" value="${data.id}">'+
                    '<input type="text" class="form-control form-control-sm form-control-light" name="media[priority][]" value="${data.priority}"></td>' +
                '<td><div class="column-thumbnail">${image}<span class="fileuploader-action-popup"></span></div></td>' +
                '<td><div class="column-title"><input type="text" class="form-control" name="media[alt][]" value="${data.alt}"></div></td>' +
                '<td><div class="column-actions">' +
                    '<a href="${file}" class="fileuploader-action fileuploader-action-download" title="${captions.download}" download><i></i></a>' +
                    '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                '</div></td>' +
            '</tr>',
            popup: {
                onShow: function(item) {
                    item.popup.html.on('click', '[data-action="prev"]', function(e) {
                        item.popup.move('prev');
                    }).on('click', '[data-action="next"]', function(e) {
                        item.popup.move('next');
                    }).on('click', '[data-action="crop"]', function(e) {
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
            removeConfirmation: true,
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
        sorter: {
            selectorExclude: null,
            placeholder: null,
            scrollContainer: window,
            onSort: function(list, listEl, parentEl, newInputEl, inputEl) {
                // onSort callback
            }
        },
        // upload: {
        //     url: 'php/ajax_upload_file.php',
        //     data: null,
        //     type: 'POST',
        //     enctype: 'multipart/form-data',
        //     start: false,
        //     synchron: true,
        //     beforeSend: function(item, listEl, parentEl, newInputEl, inputEl) {
        //         // add image to formData
        //         if (item.editor && item.editor._blob) {
        //             item.upload.data.fileuploader = 1;
        //             if (item.upload.formData.delete)
        //                 item.upload.formData.delete(inputEl.attr('name'));
        //             item.upload.formData.append(inputEl.attr('name'), item.editor._blob, item.name);
        //             // add name to data
        //             if (item.editor._namee) {
        //                 item.upload.data._namee = item.name;
        //             }
        //             // add is after editing to data
        //             if (item.editor._editingg) {
        //                 item.upload.data._editingg = true;
        //             }
        //         }
        //         item.html.find('.fileuploader-action-success').removeClass('fileuploader-action-success');
        //     },
        //     onSuccess: function(result, item) {
        //         var data = {};
        //         try {
        //             data = JSON.parse(result);
        //         } catch (e) {
        //             data.hasWarnings = true;
        //         }
        //         // if success
        //         if (data.isSuccess && data.files[0]) {
        //             item.name = data.files[0].name;
        //             item.html.find('.column-title > div:first-child').text(data.files[0].name).attr('title', data.files[0].name);
        //             // send pending editor
        //             if (item.editor && item.editor.isUploadPending) {
        //                 delete item.editor.isUploadPending;
        //                 saveEditedImage(item.editor._blob, item);
        //             }
        //         }
        //         // if warnings
        //         if (data.hasWarnings) {
        //             for (var warning in data.warnings) {
        //                 alert(data.warnings);
        //             }
        //             item.html.removeClass('upload-successful').addClass('upload-failed');
        //             // go out from success function by calling onError function
        //             // in this case we have a animation there
        //             // you can also response in PHP with 404
        //             return this.onError ? this.onError(item) : null;
        //         }
        //         item.html.find('.fileuploader-action-remove').addClass('fileuploader-action-success');
        //         setTimeout(function() {
        //             item.html.find('.progress-bar2').fadeOut(400);
        //         }, 400);
        //     },
        //     onError: function(item) {
        //         var progressBar = item.html.find('.progress-bar2');
        //         if (progressBar.length) {
        //             progressBar.find('span').html(0 + "%");
        //             progressBar.find('.fileuploader-progressbar .bar').width(0 + "%");
        //             item.html.find('.progress-bar2').fadeOut(400);
        //         }
        //         item.upload.status != 'cancelled' && item.html.find('.fileuploader-action-retry').length == 0 ? item.html.find('.column-actions').prepend(
        //             '<a class="fileuploader-action fileuploader-action-retry" title="Retry"><i></i></a>'
        //         ) : null;
        //     },
        //     onProgress: function(data, item) {
        //         var progressBar = item.html.find('.progress-bar2');
        //         if (progressBar.length > 0) {
        //             progressBar.show();
        //             progressBar.find('span').html(data.percentage + "%");
        //             progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
        //         }
        //     },
        //     onComplete: null,
        // },
        onRemove: function(item, listEl, parentEl, newInputEl, inputEl) {
            var url = window.location.href.split(/[?#]/)[0];
            url = url.split('/create')[0]; url = url.split('/edit')[0];

            axios.delete( url + '/remove-media',{
                data : item.data
            }).then(res => {
            }).catch(error => {
                $.NotificationApp.send(error.response.status, error.response.statusText, "top-right", "rgba(0,0,0,0.2)", 'error');
            });

        },
        editor: {
            cropper: {
                showGrid: true
            },
            maxWidth: 800,
            maxHeight: 600,
            quality: 98
        },
        dialogs: {
            alert: function(text) {
                return alert(text)
            },
            confirm: function(text, callback) {
                confirm(text) ? callback() : null
            }
        },
        captions: {
            feedback: 'Drag and drop files here',
            or: 'or',
            button: 'Browse Files',
        }
    });
});