<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Eleman Dental</title>
</head>
<body style="margin:0; padding:0; background-color:#f2f0f1; font-family:'Segoe UI', Roboto, Arial, sans-serif; -webkit-text-size-adjust:100%;">
    <div style="display:none; max-height:0; overflow:hidden; opacity:0;">@yield('preheader', 'Eleman Dental')</div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f2f0f1; padding:32px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px; width:100%; background-color:#ffffff; border-radius:16px; overflow:hidden; box-shadow:0 8px 30px rgba(38,3,10,0.10);">

                    <!-- header -->
                    <tr>
                        <td style="background-color:#6B0B0C; background-image:linear-gradient(135deg,#850014 0%,#4a060f 100%); padding:34px 40px; text-align:center;">
                            <div style="font-size:29px; font-weight:800; letter-spacing:3px; color:#ffffff; margin:0;">ELEMAN&nbsp;DENTAL</div>
                            <div style="font-size:13px; color:rgba(255,255,255,0.82); margin-top:6px; letter-spacing:.5px;">Premium Dental Equipment &amp; Supplies</div>
                        </td>
                    </tr>

                    <!-- body -->
                    <tr>
                        <td style="padding:38px 40px 26px 40px;">
                            @yield('content')
                        </td>
                    </tr>

                    <!-- divider -->
                    <tr><td style="padding:0 40px;"><div style="height:1px; background-color:#eeecec;"></div></td></tr>

                    <!-- contact -->
                    <tr>
                        <td style="padding:24px 40px 8px 40px; text-align:center;">
                            <p style="margin:0 0 6px 0; font-size:13px; color:#7a8089;">Need help? We’re here for you.</p>
                            <p style="margin:0; font-size:13px; color:#6B0B0C; font-weight:600;">+20 100 754 1447 &nbsp;•&nbsp; info@elemandental.com</p>
                        </td>
                    </tr>

                    <!-- footer -->
                    <tr>
                        <td style="padding:22px 40px 30px 40px; text-align:center;">
                            <p style="margin:0; font-size:12px; color:#adb2ba;">© {{ date('Y') }} Eleman Dental — Cairo &amp; Zagazig, Egypt.<br>All rights reserved.</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
