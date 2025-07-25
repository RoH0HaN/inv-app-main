!(function ($) {
    "use strict";
    $("#sidebarToggle, #sidebarToggleTop").on("click", function (e) {
        $("body").toggleClass("sidebar-toggled"),
            $(".sidebar").toggleClass("toggled"),
            $(".sidebar").hasClass("toggled") &&
                $(".sidebar .collapse").collapse("hide");
    }),
        $(window).resize(function () {
            $(window).width() < 768 && $(".sidebar .collapse").collapse("hide");
        }),
        $("body.fixed-nav .sidebar").on(
            "mousewheel DOMMouseScroll wheel",
            function (e) {
                if ($(window).width() > 768) {
                    var e0 = e.originalEvent,
                        delta = e0.wheelDelta || -e0.detail;
                    (this.scrollTop += 30 * (delta < 0 ? 1 : -1)),
                        e.preventDefault();
                }
            },
        ),
        $(document).on("scroll", function () {
            var scrollDistance;
            $(this).scrollTop() > 100
                ? $(".scroll-to-top").fadeIn()
                : $(".scroll-to-top").fadeOut();
        }),
        $(document).on("click", "a.scroll-to-top", function (e) {
            var $anchor = $(this);
            $("html, body")
                .stop()
                .animate(
                    { scrollTop: $($anchor.attr("href")).offset().top },
                    1e3,
                    "easeInOutExpo",
                ),
                e.preventDefault();
        });
})(jQuery),
    $(document).ready(function () {
        $("#myBtn").click(function () {
            $(".modal").modal("show");
        }),
            $("#modalLong").click(function () {
                $(".modal").modal("show");
            }),
            $("#modalScroll").click(function () {
                $(".modal").modal("show");
            }),
            $("#modalCenter").click(function () {
                $(".modal").modal("show");
            });
    }),
    $(function () {
        $('[data-toggle="popover"]').popover();
    }),
    $(".popover-dismiss").popover({ trigger: "focus" });
