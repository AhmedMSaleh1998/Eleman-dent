@extends('emails._layout')

@section('preheader', 'Your Eleman Dental verification code is ' . $mailData['code'])

@section('content')
    <h1 style="margin:0 0 12px 0; font-size:22px; font-weight:800; color:#1c1c22;">Welcome to Eleman Dental 👋</h1>
    <p style="margin:0 0 8px 0; font-size:15px; line-height:1.7; color:#555b66;">
        Hello <strong style="color:#1c1c22;">{{ $mailData['email'] }}</strong>,
    </p>
    <p style="margin:0 0 26px 0; font-size:15px; line-height:1.7; color:#555b66;">
        Thank you for creating an account. Please use the verification code below to activate your account.
    </p>

    <!-- code box -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding:6px 0 30px 0;">
                <div style="display:inline-block; background-color:#fdf3f4; border:1.5px dashed #d9a3ab; border-radius:12px; padding:18px 40px;">
                    <div style="font-size:12px; font-weight:700; letter-spacing:1px; color:#8a1f2c; text-transform:uppercase; margin-bottom:8px;">Verification Code</div>
                    <div style="font-size:38px; font-weight:800; letter-spacing:10px; color:#6B0B0C; line-height:1;">{{ $mailData['code'] }}</div>
                </div>
            </td>
        </tr>
    </table>

    <p style="margin:0; font-size:13px; line-height:1.7; color:#9aa0ab;">
        If you didn’t request this, you can safely ignore this email.
    </p>
@endsection
