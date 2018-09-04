!function(e) {
    "use strict";
    var t = function() {};
    t.prototype.send = function(t, n, i, r, o, s, a, l) {
        s || (s = 3e3), a || (a = 1);
        var c = {
            heading: t,
            text: n,
            position: i,
            loaderBg: r,
            icon: o,
            hideAfter: s,
            stack: a
        };
        c.showHideTransition = l || "fade", e.toast().reset("all"), e.toast(c)
    }, e.NotificationApp = new t, e.NotificationApp.Constructor = t
}(window.jQuery),
function(e) {
    "use strict";
    var t = function() {};
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
    });

    var url = window.location.href.split(/[?#]/)[0];
    url = url.split('/create')[0]; url = url.split('/edit')[0];
    
    t.prototype.changeToSlug = function(str) {
        str = str.toLowerCase();
        str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
        str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
        str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
        str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
        str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
        str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
        str = str.replace(/(đ)/g, 'd');
        str = str.replace(/([^0-9a-z-\s])/g, '');
        str = str.replace(/(\s+)/g, '-');
        str = str.replace(/^-+/g, '');
        str = str.replace(/-+$/g, '');
        return str;
    }, t.prototype.updatePriority = function(id,priority,event) {
        event.preventDefault();
        var btn = event.target;
        axios.post( url + '/priority',{
            id: id,
            priority: priority
        }).then(res => {
            if(res.data.class === 'success'){
                e(btn).toggleClass('btn-info').toggleClass('btn-secondary');
            }
            e.NotificationApp.send(res.data.head, res.data.message, "top-right", "rgba(0,0,0,0.2)", res.data.class);
        }).catch(error => {
            e.NotificationApp.send(error.response.status, error.response.statusText, "top-right", "rgba(0,0,0,0.2)", 'error');
        });
    }, t.prototype.changeStatus = function(id,status,event) {
        event.preventDefault();
        var btn = event.target;
        axios.post( url + '/status',{
            id: id,
            status: status
        }).then(res => {
            if(res.data.class === 'success'){
                e(btn).toggleClass('btn-info').toggleClass('btn-secondary');
            }
            e.NotificationApp.send(res.data.head, res.data.message, "top-right", "rgba(0,0,0,0.2)", res.data.class);
        }).catch(error => {
            e.NotificationApp.send(error.response.status, error.response.statusText, "top-right", "rgba(0,0,0,0.2)", 'error');
        });
    }, t.prototype.changeMultiStatus = function(status,event){
        event.preventDefault();
        if( e('input[name="checkAction[]"]').is(':checked') ){
            var ids = e('input[name="checkAction[]"]:checked').map( function () { return this.value; } ).get().join(",");
            axios.post( url + '/status',{
                id: ids,
                status: status
            }).then(res => {
                if(res.data.class === 'success'){
                    e('input[name="checkAction[]"]:checked').map(function () {
                        e(this).closest('tr').find('.btn-status-'+status).toggleClass('btn-info').toggleClass('btn-secondary');
                    });
                }
                e.NotificationApp.send(res.data.head, res.data.message, "top-right", "rgba(0,0,0,0.2)", res.data.class);
            }).catch(error => {
                e.NotificationApp.send(error.response.status, error.response.statusText, "top-right", "rgba(0,0,0,0.2)", 'error');
            });
        }else{
            e.NotificationApp.send("Cảnh báo!", "Chưa có mục nào được chọn", "top-center", "rgba(0,0,0,0.2)", "warning");
        }
        
    }, t.prototype.deleteRow = function(id,event){
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
                axios.delete( url + '/'+id)
                .then(res => {
                    if(res.data.class === 'success'){
                        e(btn).closest('tr').slideUp('slow', function() {
                            e(this).remove();
                        });
                    }
                    swalWithBootstrapButtons(res.data.head,res.data.message,res.data.class);
                }).catch(error => {
                    e.NotificationApp.send(error.response.status, error.response.statusText, "top-right", "rgba(0,0,0,0.2)", 'error');
                });
            } else if ( res.dismiss === swal.DismissReason.cancel ) {
                swalWithBootstrapButtons('Hủy bỏ','Bạn đã hủy bỏ thao tác này.','error')
            }
        });
    }, t.prototype.deleteMultiRows = function(event){
        event.preventDefault();
        if( e('input[name="checkAction[]"]').is(':checked') ){
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
                    e('input[name="checkAction[]"]:checked').map(function () {
                        var id = this.value;
                        axios.delete( url + '/'+id)
                        .then(res => {
                            if(res.data.class === 'success'){
                                e(this).closest('tr').slideUp('slow', function() {
                                    e(this).remove();
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
            e.NotificationApp.send("Cảnh báo!", "Chưa có mục nào được chọn", "top-center", "rgba(0,0,0,0.2)", "warning");
        }
    }, e.Tools = new t, e.Tools.Constructor = t
}(window.jQuery),
function(e) {
    "use strict";
    var t = function() {};
    t.prototype.initTooltipPlugin = function() {
        e.fn.tooltip && e('[data-toggle="tooltip"]').tooltip()
    }, t.prototype.initPopoverPlugin = function() {
        e.fn.popover && e('[data-toggle="popover"]').popover()
    }, t.prototype.initSlimScrollPlugin = function() {
        e.fn.slimScroll && e(".slimscroll").slimScroll({
            height: "auto",
            position: "right",
            size: "8px",
            touchScrollStep: 20,
            color: "#9ea5ab"
        })
    }, t.prototype.initFormValidation = function() {
        e(".needs-validation").on("submit", function(t) {
            return e(this).addClass("was-validated"), !1 !== e(this)[0].checkValidity() || (t.preventDefault(), t.stopPropagation(), !1)
        }), e(".form-validation").validationEngine()
    }, t.prototype.initCheckboxGroup = function() {
            var t = this;
            e('.custom-checkbox-all').on('change', 'input', function(t) {
                e('.custom-checkbox input[data-group="' + t.target.getAttribute('data-group') + '"]').not(this).prop('checked', e(t.target).prop('checked'))
            })
    }, t.prototype.initSlug = function() {
            e('input.link-to-slug').on('blur', function(){
                var str = e.Tools.changeToSlug(e(this).val());
                e('input[name="slug"]').val(str);
            }), e('input[name="slug"]').on('blur', function(){
                var str = e.Tools.changeToSlug(e(this).val());
                e(this).val(str);
            })
    }, t.prototype.init = function() {
        this.initTooltipPlugin(), this.initPopoverPlugin(), this.initSlimScrollPlugin(), this.initFormValidation(), this.initCheckboxGroup(), this.initSlug()
    }, e.Components = new t, e.Components.Constructor = t
}(window.jQuery),
function(e) {
    "use strict";
    var t = function() {
        this.$body = e("body"), this.$window = e(window)
    };
    t.prototype._resetSidebarScroll = function() {
        e(".slimscroll-menu").slimscroll({
            height: "auto",
            position: "right",
            size: "8px",
            color: "#9ea5ab",
            wheelStep: 5,
            touchScrollStep: 20
        })
    }, t.prototype.initMenu = function() {
        var t = this;
        e(".button-menu-mobile").on("click", function(e) {
            e.preventDefault(), t.$body.toggleClass("sidebar-enable"), t.$window.width() > 768 ? t.$body.toggleClass("enlarged") : t.$body.removeClass("enlarged"), t._resetSidebarScroll()
        }), e(".side-nav").metisMenu(), t._resetSidebarScroll(), e(".side-nav a").each(function() {
            var t = window.location.href.split(/[?#]/)[0];
            t = t.split('/create')[0];
            t = t.split('/edit')[0];
            this.href.split(/[?#]/)[0] == t && (e(this).addClass("active"), e(this).parent().addClass("active"), e(this).parent().parent().addClass("in"), e(this).parent().parent().prev().addClass("active"), e(this).parent().parent().parent().addClass("active"), e(this).parent().parent().parent().parent().addClass("in"), e(this).parent().parent().parent().parent().parent().addClass("active"))
        }), e(".topnav-menu li a").each(function() {
            var t = window.location.href.split(/[?#]/)[0];
            t = t.split('create')[0];
            t = t.split('edit')[0];
            this.href.split(/[?#]/)[0] == t && (e(this).addClass("active"), e(this).parent().parent().addClass("active"), e(this).parent().parent().parent().parent().addClass("active"))
        }), e(".navbar-toggle").on("click", function(t) {
            e(this).toggleClass("open"), e("#navigation").slideToggle(400)
        }), e(".dropdown-menu a.dropdown-toggle").on("click", function(t) {
            return e(this).next().hasClass("show") || e(this).parents(".dropdown-menu").first().find(".show").removeClass("show"), e(this).next(".dropdown-menu").toggleClass("show"), !1
        })
    }, t.prototype.initLayout = function() {
        this.$window.width() >= 768 && this.$window.width() <= 1028 ? this.$body.addClass("enlarged") : 1 != this.$body.data("keep-enlarged") && this.$body.removeClass("enlarged")
    }, t.prototype.init = function() {
        var t = this;
        this.initLayout(), this.initMenu(), e.Components.init(), t.$window.on("resize", function(e) {
            e.preventDefault(), t.initLayout(), t._resetSidebarScroll()
        })
    }, e.App = new t, e.App.Constructor = t
}(window.jQuery),
function(e) {
    "use strict";
    e.App.init()
}(window.jQuery);