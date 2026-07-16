@extends('emails._layout')

@section('preheader', 'New order placed on Eleman Dental')

@section('content')
    <!-- alert badge -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding-bottom:16px;">
                <div style="width:64px; height:64px; line-height:64px; border-radius:50%; background-color:#fdf3f4; color:#6B0B0C; font-size:30px; text-align:center;">&#128717;</div>
            </td>
        </tr>
    </table>

    <h1 style="margin:0 0 10px 0; font-size:22px; font-weight:800; color:#1c1c22; text-align:center; direction:rtl;">
        طلب جديد على الموقع 🔔
    </h1>

    <p style="margin:0 0 22px 0; font-size:15px; line-height:1.9; color:#555b66; text-align:center; direction:rtl;">
        قام أحد المستخدمين بإنشاء طلب جديد على موقع <strong style="color:#6B0B0C;">إيمان دنتال</strong>.
        يرجى مراجعة الطلب، وتحديد مصاريف الشحن، والتواصل مع العميل في أسرع وقت.
    </p>

    <!-- customer details -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#fafafb; border:1px solid #eeecec; border-radius:12px;">
        <tr>
            <td style="padding:20px 22px; direction:rtl;">
                <div style="font-size:12px; font-weight:700; letter-spacing:.5px; color:#8a8f9a; text-transform:uppercase; margin-bottom:12px;">بيانات العميل</div>

                <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="padding:6px 0; font-size:14px; color:#8a8f9a; width:90px;">الاسم</td>
                        <td style="padding:6px 0; font-size:14px; font-weight:700; color:#1c1c22;">{{ trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: '—' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:6px 0; font-size:14px; color:#8a8f9a;">البريد</td>
                        <td style="padding:6px 0; font-size:14px; font-weight:700; color:#1c1c22; direction:ltr;">
                            <a href="mailto:{{ $user->email }}" style="color:#6B0B0C; text-decoration:none;">{{ $user->email }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:6px 0; font-size:14px; color:#8a8f9a;">الهاتف</td>
                        <td style="padding:6px 0; font-size:14px; font-weight:700; color:#1c1c22; direction:ltr;">
                            <a href="tel:{{ $user->phone }}" style="color:#6B0B0C; text-decoration:none;">{{ $user->phone }}</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection
