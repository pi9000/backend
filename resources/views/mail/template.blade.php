<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title }} Whitelabel System</title>
</head>

<body style="margin: 0px; background: #EDF2F7">
    <div width="100%" style="
        background: #EDF2F7;
        padding: 0px 0px;
        font-family: arial;
        line-height: 28px;
        height: 100%;
        width: 100%;
        color: #514d6a;
      ">
        <div style="
          max-width: 700px;
          padding: 50px 0;
          margin: 0px auto;
          font-size: 14px;
        ">
            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
                <tbody>
                    <tr>
                        <td style="vertical-align: top; padding-bottom: 30px" align="center">
                            <img src="{{ $logo }}" alt="{{ $title }}" style="border: none" width="255"/>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="padding: 40px; background: #fff">
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                    <tbody>
                        <tr>
                            <td>
                                <p>Hi <b>{{ $user }}</b> ( {{ $agent }} ),</p>
                                <p>
                                    Below is your OTP code
                                    <br>
                                    <b style="color: #2986cc;">{{ $code }}</b>
                                    <br>
                                    Please verify in OTP Verification page
                                </p>
                                <br>
                                <p>Greeting from, <br>
                                    {{ $title }}</p>

                                    <code>[THIS IS AN AUTOMATED MESSAGE - PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL]</code>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                © {{ date('Y') }} {{ $title }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
