<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"
    style="font-family: 'Roboto', sans-serif;">
    <!-- START HEADER/BANNER -->
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <tbody>
        <tr>
            <td align="center">
                <table class="" width="800" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td align="center" valign="top" 
                                style="background-size:cover; background-position:top; background-image: url('{{asset('admin_assets/images/bb.png')}}')">
                                <table class="" width="800" border="0" align="center" cellpadding="0"
                                    cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td height="40"></td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="line-height: 0px;">
                                                <img style="display:block; line-height:0px; font-size:0px; border:0px;"
                                                    src="{{asset('admin_assets/images/logo2.png')}}" width="140" height=""
                                                    alt="logo">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="40"></td>
                                        </tr>
                                        <tr>
                                            <td align="center"
                                                style=" font-size: 30px; color: #ffffff; line-height: 40px; font-weight: 600; letter-spacing: 2px; padding: 0px 40px;">
                                                {!! $maildata['title'] !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="50"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center">
                <table class="" width="800" border="0" align="center" cellpadding="0" cellspacing="0"
                    style="background: #e6edee;">
                    <tbody>
                        <tr>
                            <td height="35"></td>
                        </tr>
                        <tr>
                            <td align="left" style="padding: 0 40px;">
                                {!! $maildata['mail_content'] !!}
                            </td>
                        </tr>
                        <tr>
                            <td height="35"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
