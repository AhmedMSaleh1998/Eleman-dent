{{-- بتظهر لما حجم الطلب يتخطى post_max_size بتاع PHP (قبل ما يوصل للفاليديشن) --}}
<div dir="rtl" lang="ar" style="font-family:Tahoma,Arial,sans-serif;background:#f4f6f9;min-height:100vh;margin:0;display:flex;align-items:center;justify-content:center;padding:20px">
    <div style="background:#fff;border-radius:8px;box-shadow:0 1px 4px rgba(0,0,0,.12);max-width:520px;width:100%;padding:32px;text-align:center">
        <div style="font-size:48px;line-height:1;color:#dd4b39;margin-bottom:16px">&#9888;</div>

        <h1 style="font-size:22px;color:#333;margin:0 0 12px">الملف كبير جداً</h1>

        <p style="font-size:15px;color:#666;line-height:1.9;margin:0 0 24px">
            {{ postTooLargeMessage() }}
        </p>

        <a href="{{ url()->previous() }}"
            style="display:inline-block;background:#3c8dbc;color:#fff;text-decoration:none;padding:10px 24px;border-radius:4px;font-size:15px">
            رجوع
        </a>
    </div>
</div>
