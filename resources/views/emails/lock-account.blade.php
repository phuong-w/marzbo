@extends('emails.layouts.app-mail')

@section('content-main')
    <tr>
        <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
            <center>
                <table cellspacing="0" cellpadding="0" width="600" class="w320">
                    <tr>
                        <td class="header-lg">
                            Hi {{ $data['name'] }}
                        </td>
                    </tr>
                    <tr>
                        <td class="free-text">
                            <p> {{ $data['content'] }} </p>

                            <p>Best regards,</p>
                            <p>Admin - Team Marzbo</p>
                        </td>
                    </tr>
                </table>
            </center>
        </td>
    </tr>
@endsection
