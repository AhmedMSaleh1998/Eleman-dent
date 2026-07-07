<style>
    /* قائمة الإجراءات المنسدلة في جداول لوحة التحكم */
    .action-dd {
        display: inline-block;
    }

    .action-dd .dropdown-toggle {
        min-width: 110px;
    }

    .action-dd .dropdown-menu {
        min-width: 180px;
        text-align: right;
        direction: rtl;
        border: 1px solid #e3e8ee;
        border-radius: 8px;
        box-shadow: 0 6px 18px rgba(20, 40, 60, 0.12);
        padding: 6px 0;
    }

    .action-dd .dropdown-item {
        padding: 8px 16px;
        font-size: 13.5px;
        color: #2d3b48;
    }

    .action-dd .dropdown-item i {
        width: 18px;
        margin-left: 8px;
        text-align: center;
        color: #1abc9c;
    }

    .action-dd .dropdown-item:hover {
        background: #f2faf8;
    }

    .action-dd .dropdown-item.text-danger i {
        color: #e74c3c;
    }

    .action-dd .dropdown-item.text-danger:hover {
        background: #fdeaea;
        color: #c0392b;
    }

    /* عشان القائمة ما تتقصش جوه حاويات الجداول */
    .table-responsive,
    .fixed-table-container,
    .fixed-table-body {
        overflow: visible !important;
    }
</style>
