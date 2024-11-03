<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';background-color:#222a35;margin:0;padding:0 100px;width:100%">

    <tbody>

        <tr>

            <td align="center" style="">

                <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin:0;padding:0;width:100%">

                    <tbody>

                        <tr>

                            <td width="100%" cellpadding="0" cellspacing="0" style="">

                                <table align="center" cellpadding="0" cellspacing="0" role="presentation" style="color:#ffffff;">

                                    <tbody>

                                        <tr align="center" style="padding:30px">

                                            <td align="center" style="padding:30px">

                                                @if(isset($email))

                                                <p style="font-size:20px;line-height:1.2em;">Hi : {{$email}}</p>

                                                @else

                                                <p style="font-size:20px;line-height:1.2em;">Hi : {{$name}}</p>

                                                @endif

                                                <br>

                                                <h1 style="font-size:32px;font-weight:normal;">Welcome to Niroghyam.</h1>

                                                <br>

                                                @if(isset($token))

                                                 <p style="font-size:15px;line-height:1.2em;"> Please click this below link to create new password : <span style="background:lightgray;padding:5px;color:black;font-weight: bold;"><a href="{{$token}}">Click Here</a></span></p>

                                                @else

                                                 <p style="font-size:15px;line-height:1.2em;"> Your New Password Is : <span style="background:lightgray;padding:5px;color:black;font-weight: bold;">{{$code}}</span></p>

                                                  <br>


                                                @endif
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