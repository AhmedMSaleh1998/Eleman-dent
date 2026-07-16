@extends('emails._layout')

@section('preheader', 'Your Eleman Dental order has been received')

@section('content')
    <!-- success badge -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding-bottom:18px;">
                <div style="width:64px; height:64px; line-height:64px; border-radius:50%; background-color:#eafaf1; color:#0a7d3f; font-size:32px; text-align:center;">&#10004;</div>
            </td>
        </tr>
    </table>

    <h1 style="margin:0 0 12px 0; font-size:22px; font-weight:800; color:#1c1c22; text-align:center; direction:rtl;">
        {{ $user->first_name ?? '' }}، تم استلام طلبك بنجاح 🎉
    </h1>

    <p style="margin:0 0 20px 0; font-size:15px; line-height:1.9; color:#555b66; text-align:center; direction:rtl;">
        شكراً لطلبك من <strong style="color:#6B0B0C;">إيمان دنتال</strong>.
        سيتواصل معك فريق المبيعات في أسرع وقت لتأكيد الطلب، وتحديد تكلفة الشحن وموعد التوصيل.
    </p>

    <!-- next step strip -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#fafafb; border:1px solid #eeecec; border-radius:12px;">
        <tr>
            <td style="padding:16px 20px; text-align:center; direction:rtl;">
                <div style="font-size:13px; color:#8a8f9a; margin-bottom:4px;">الخطوة التالية</div>
                <div style="font-size:14px; font-weight:700; color:#1c1c22;">سيتصل بك قسم المبيعات لتأكيد التفاصيل 📞</div>
            </td>
        </tr>
    </table>

    <p style="margin:22px 0 0 0; font-size:13px; line-height:1.7; color:#9aa0ab; text-align:center;">
        Thank you for choosing Eleman Dental.
    </p>
@endsection
