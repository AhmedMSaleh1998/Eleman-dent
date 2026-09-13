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
});
