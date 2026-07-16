@extends('emails._layout')

@section('preheader', 'تحديث حالة طلبك رقم ' . $order->id)

@section('content')
    <h1 style="margin:0 0 10px 0; font-size:22px; font-weight:800; color:#1c1c22; text-align:center; direction:rtl;">
        {{ optional($order->user)->first_name ?? '' }}، تم تحديث حالة طلبك
    </h1>

    <p style="margin:0 0 22px 0; font-size:15px; line-height:1.8; color:#555b66; text-align:center; direction:rtl;">
        طلبك رقم <strong style="color:#6B0B0C;">#{{ $order->id }}</strong> أصبحت حالته الآن:
    </p>

    <!-- status badge -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding-bottom:22px;">
                <span style="display:inline-block; padding:10px 26px; border-radius:999px; font-size:17px; font-weight:800; color:{{ $statusInfo['color'] }}; background-color:{{ $statusInfo['bg'] }};">
                    {{ $statusInfo['label'] }}
                </span>
            </td>
        </tr>
    </table>

    <p style="margin:0 0 24px 0; font-size:14.5px; line-height:1.9; color:#555b66; text-align:center; direction:rtl;">
        {{ $statusInfo['msg'] }}
    </p>

    <!-- order summary -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#fafafb; border:1px solid #eeecec; border-radius:12px;">
        <tr>
            <td style="padding:18px 22px; direction:rtl;">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="padding:6px 0; font-size:14px; color:#8a8f9a; width:110px;">رقم الطلب</td>
                        <td style="padding:6px 0; font-size:14px; font-weight:700; color:#1c1c22;">#{{ $order->id }}</td>
                    </tr>
                    @if($order->total)
                    <tr>
                        <td style="padding:6px 0; font-size:14px; color:#8a8f9a;">الإجمالي</td>
                        <td style="padding:6px 0; font-size:14px; font-weight:800; color:#6B0B0C;">{{ number_format($order->total) }} ج.م</td>
                    </tr>
                    @endif
                    @if(optional($order->address)->street)
                    <tr>
                        <td style="padding:6px 0; font-size:14px; color:#8a8f9a;">العنوان</td>
                        <td style="padding:6px 0; font-size:14px; font-weight:700; color:#1c1c22;">{{ optional(optional($order->address)->city)->name }}، {{ optional($order->address)->street }}</td>
                    </tr>
                    @endif
                </table>
            </td>
        </tr>
    </table>

    <p style="margin:22px 0 0 0; font-size:13px; line-height:1.7; color:#9aa0ab; text-align:center; direction:rtl;">
        لأي استفسار يسعدنا تواصلك معنا.
    </p>
@endsection
