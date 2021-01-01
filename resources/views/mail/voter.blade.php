<!doctype html>
<html>
<body
    style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;background-color: rgb(245,248,250);color: rgb(116,120,126);height: 100.0%;line-height: 1.4;margin: 0;width: 100.0%;font-family: Verdana;font-size: 12.0px;">
<style>
    @media only screen and (max-width: 600.0px) {
        *.inner-body {
            width: 100.0%;
        }

        *.footer {
            width: 100.0%;
        }
    }

    @media only screen and (max-width: 500.0px) {
        *.button {
            width: 100.0%;
        }
    }
</style>
<table cellpadding="0" cellspacing="0" class="wrapper"
       style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;background-color: rgb(245,248,250);margin: 0;padding: 0;width: 100.0%;"
       width="100%">
    <tbody>
    <tr>
        <td align="center" style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;">
            <table cellpadding="0" cellspacing="0" class="content"
                   style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;margin: 0;padding: 0;width: 100.0%;"
                   width="100%">
                <tbody>
                <tr>
                    <td class="header"
                        style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;padding: 25.0px 0;text-align: center;">
                        <span
                            style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;color: rgb(187,191,195);font-size: 19.0px;font-weight: bold;text-decoration: none;text-shadow: 0 1.0px 0 white;">
                           {{$election->name}}</span>
                    </td>
                </tr>
                <tr>
                    <td class="body"
                        style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;background-color: rgb(255,255,255);border-bottom: 1.0px solid rgb(237,239,242);border-top: 1.0px solid rgb(237,239,242);margin: 0;padding: 0;width: 100.0%;"
                        width="100%">
                        <table align="center" cellpadding="0" cellspacing="0" class="inner-body"
                               style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;background-color: rgb(255,255,255);margin: 0 auto;padding: 0;width: 570.0px;"
                               width="570">
                            <tbody>
                            <tr>
                                <td class="content-cell"
                                    style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;padding: 35.0px;">
                                    <h1 style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;color: rgb(47,49,51);font-size: 19.0px;font-weight: bold;margin-top: 0;text-align: left;">
                                        Hello!</h1>
                                    <p style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;color: rgb(116,120,126);font-size: 16.0px;line-height: 1.5em;margin-top: 0;text-align: left;">
                                        You've been invited to take part in an online election. You can vote straight
                                        away by using the button below, or log in manually with the details below.</p>
                                    <table align="center" cellpadding="0" cellspacing="0" class="action"
                                           style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;margin: 30.0px auto;padding: 0;text-align: center;width: 100.0%;"
                                           width="100%">
                                        <tbody>
                                        <tr>
                                            <td align="center"
                                                style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;">
                                                <table border="0" cellpadding="0" cellspacing="0"
                                                       style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;"
                                                       width="100%">
                                                    <tbody>
                                                    <tr>
                                                        <td align="center"
                                                            style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;">
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                   style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;">
                                                                        <a class="button button-primary"
                                                                           href="/elections/{{$election->slug}}/login/{{$voter->username}}/{{$voter->password_plain}}"
                                                                           style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;color: rgb(255,255,255);display: inline-block;text-decoration: none;background-color: rgb(48,151,209);border-top: 10.0px solid rgb(48,151,209);border-right: 18.0px solid rgb(48,151,209);border-bottom: 10.0px solid rgb(48,151,209);border-left: 18.0px solid rgb(48,151,209);"
                                                                           target="_blank">Vote Now</a>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <p style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;color: rgb(116,120,126);font-size: 16.0px;line-height: 1.5em;margin-top: 0;text-align: left;">
                                        Please visit <a href="/elections/{{$election->slug}}">/elections/{{$election->slug}}</a>
                                        to log in,
                                        using the following voting code and security code:<br>
                                        Voting Code: {{$voter->username}}<br>
                                        Security Code: {{$voter->password_plain}}</p>
                                    <p style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;color: rgb(116,120,126);font-size: 16.0px;line-height: 1.5em;margin-top: 0;text-align: left;">
                                        Regards,<br>
                                    </p>
                                    <table cellpadding="0" cellspacing="0" class="subcopy"
                                           style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;border-top: 1.0px solid rgb(237,239,242);margin-top: 25.0px;padding-top: 25.0px;"
                                           width="100%">
                                        <tbody>
                                        <tr>
                                            <td style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;">
                                                <p style="font-family: Avenir , Helvetica , sans-serif;box-sizing: border-box;color: rgb(116,120,126);line-height: 1.5em;margin-top: 0;text-align: left;font-size: 12.0px;">
                                                    If you would rather not receive emails like this, please click here:
                                                    <a href="%tag_unsubscribe_url%">unsubscribe.</a> If you would like to opt out of
                                                    <strong>all</strong> future election invites, please click here:
                                                    <a href="%unsubscribe_url%">I do not want to receive voting invites in the future.</a>
                                                </p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
