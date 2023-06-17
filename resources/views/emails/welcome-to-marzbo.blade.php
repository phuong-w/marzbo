@extends('emails.layouts.app-mail')

@section('content-main')
    <tr>
        <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
            <center>
                <table cellspacing="0" cellpadding="0" width="600" class="w320">
                    <tr>
                        <td class="header-lg">
                            Welcome {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="free-text">
                            <p>Congratulations on becoming a new member of Marzbo! We're glad you signed up for an account on our app.</p>
                            <p>Marzbo is an application that simultaneously manages your social network accounts, and analyzes and provides you with data on your posts on social networking platforms such as Facebook, Tiktok, Instagram, etc.</p>
                            <p>Start exploring and enjoy the amazing benefits experience we have to offer.</p>
                            <p>Best regards,</p>
                            <p>Team Marzbo</p>
                            <div>
                                <a href="{{ route('home') }}" class="btn btn-primary">Visit page</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </center>
        </td>
    </tr>
@endsection
