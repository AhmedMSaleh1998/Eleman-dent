/*
 * تجاوب لوحة التحكم — يعمل مع admin_responsive.css
 * 1) يلف كل الجداول بغلاف تمرير أفقي حتى لا تكسر عرض الصفحة.
 * 2) خلفية معتمة تغلق القائمة الجانبية عند الضغط خارجها على الموبايل.
 */
$(function () {
    var $wrapper = $('#wrapper');

    // غلاف تمرير أفقي لكل جدول غير مغلف مسبقًا
    $('.content-page table').each(function () {
        var $table = $(this);
        if ($table.closest('.table-scroll-x, .table-responsive, .fixed-table-body, .mce-tinymce').length) {
            return;
        }
        // bootstrap-table يبني حاوية التمرير الخاصة به بنفسه
        if ($table.is('[data-toggle="table"]')) {
            return;
        }
        $table.wrap('<div class="table-scroll-x"></div>');
    });

    // خلفية إغلاق القائمة الجانبية
    if ($wrapper.length && !$wrapper.children('.mobile-menu-backdrop').length) {
        $('<div class="mobile-menu-backdrop"></div>')
            .appendTo($wrapper)
            .on('click', function () {
                $wrapper.addClass('enlarged');
            });
    }

    // إغلاق القائمة بعد اختيار رابط منها على الشاشات الصغيرة
    $('#sidebar-menu a').on('click', function () {
        if (window.matchMedia('(max-width: 990px)').matches) {
            $wrapper.addClass('enlarged');
        }
    });

    /*
     * القوائم المنسدلة داخل أغلفة تمرير الجداول تُقص بحدود الغلاف.
     * عند الفتح ننقل القائمة إلى body بموضع ثابت محسوب من الزر
     * فتظهر كاملة فوق كل شيء، وتعود لمكانها عند الإغلاق.
     */
    var DD_SCOPE = '.table-scroll-x .dropdown, .fixed-table-body .dropdown, ' +
        '.table-scroll-x .btn-group, .fixed-table-body .btn-group';

    $(document).on('shown.bs.dropdown', DD_SCOPE, function () {
        var $dd = $(this);
        var $menu = $dd.find('.dropdown-menu').first();
        var toggle = this.querySelector('[data-toggle="dropdown"]');
        if (!$menu.length || !toggle || $dd.data('ddMenu')) {
            return;
        }

        $dd.data('ddMenu', $menu);
        $menu.appendTo('body');

        var rect = toggle.getBoundingClientRect();
        var menuW = $menu.outerWidth();
        var menuH = $menu.outerHeight();
        var left = Math.min(Math.max(8, rect.left), window.innerWidth - menuW - 8);
        var top = rect.bottom + 4;
        if (top + menuH > window.innerHeight - 8) {
            top = Math.max(8, rect.top - menuH - 4);
        }

        $menu[0].style.setProperty('position', 'fixed', 'important');
        $menu[0].style.setProperty('top', top + 'px', 'important');
        $menu[0].style.setProperty('left', left + 'px', 'important');
        $menu[0].style.setProperty('right', 'auto', 'important');
        $menu[0].style.setProperty('bottom', 'auto', 'important');
        $menu[0].style.setProperty('transform', 'none', 'important');
        $menu[0].style.setProperty('z-index', '2050', 'important');
    });

    $(document).on('hidden.bs.dropdown', DD_SCOPE, function () {
        var $dd = $(this);
        var $menu = $dd.data('ddMenu');
        if ($menu) {
            $menu.removeAttr('style').appendTo(this);
            $dd.removeData('ddMenu');
        }
    });
});
