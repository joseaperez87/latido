<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style type="text/css">
        body {
            font-family: 'Poppins', sans-serif;
        }
        h1 {
            font-size: 24px;
        }
        .conf-token {
            padding: 10px 20px;
            background: #4F46E5;
            text-align: center;
            color: #fff;
            font-weight: 500;
            text-decoration: none;
            margin: 10px 0;
        }
        footer {
            margin-top: 20px;
            text-align: center;
        }
        footer p {
            margin-bottom: 0;
            padding-bottom: 20px;
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>{{ __('emails.confirmation.welcome_text', ['name' => 'Latido.ru']) }}</h1>
</div>
<p>
    {{ __('emails.confirmation.description',['name' => $user->name." ".$user->lastname]) }}
</p>
<a class="conf-token" target="_blank" href="{{ env('APP_URL') }}/verify/email/{{ $user->email_confirmation_token }}">{{ __('emails.confirmation.confirm_text') }}</a>
<footer>
    <p>{{ __('emails.confirmation.footer_text') }} <a href="mailto:{{ env('SUPPORT_EMAIL') }}">{{ env('SUPPORT_EMAIL') }}</a></p>
    <small><a href="//latido.ru/">Latido.ru</a> &copy; {{date('Y')}}</small>
</footer>
</body>
</html>
