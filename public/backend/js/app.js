! function(e) {
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
        })
    }, t.prototype.init = function() {
        this.initTooltipPlugin(), this.initPopoverPlugin(), this.initSlimScrollPlugin(), this.initFormValidation()
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
            this.href == t && (e(this).addClass("active"), e(this).parent().addClass("active"), e(this).parent().parent().addClass("in"), e(this).parent().parent().prev().addClass("active"), e(this).parent().parent().parent().addClass("active"), e(this).parent().parent().parent().parent().addClass("in"), e(this).parent().parent().parent().parent().parent().addClass("active"))
        }), e(".topnav-menu li a").each(function() {
            var t = window.location.href.split(/[?#]/)[0];
            this.href == t && (e(this).addClass("active"), e(this).parent().parent().addClass("active"), e(this).parent().parent().parent().parent().addClass("active"))
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