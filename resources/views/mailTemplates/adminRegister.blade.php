<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your Account</title>
    <style>
        .card {
            max-width: 600px;
            margin: 20px auto;
            border: 1px solid #dee2e6;
            border-radius: .5rem;
            box-shadow: 0 4px 8px rgba(0,0,0,.05);
            background-color: #ffffff;
        }
        .card-header {
            background-color: #0d6efd;
            color: #ffffff;
            padding: 15px;
            text-align: center;
        }
        .card-body {
            padding: 30px;
            font-family: Arial, sans-serif;
            color: #212529;
            font-size: 15px;
            line-height: 1.6;
        }
        .btn-primary {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #0d6efd;
            border-radius: .5rem;
            text-decoration: none;
            margin: 20px 0;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
        .card-footer {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
            font-size: 13px;
            color: #6c757d;
        }
        img.logo {
            max-width: 150px;
            height: auto;
            margin-bottom: 10px;
        }
    </style>
</head>
<body style="background-color:#f4f4f4; margin:0; padding:20px;">

    <div class="card">
        <!-- Header -->
        <div class="card-header">
            <img src="{{ asset('assets/logo/' . $gs->footer_logo) }}" alt="{{ $gs->title }}" class="logo"><br>
        </div>

        <!-- Body -->
        <div class="card-body">
            <p>Hello {{ $admin->name ?? 'Admin' }},</p>
            <p>Welcome to <strong>{{ $gs->title }}</strong>!  
            An administrator account has been created for you. Please click the button below to set your password and activate your account:</p>
            
            <div style="text-align:center;">
                <a href="{{ $activationUrl ?? '#' }}" class="btn-primary">Create Your Account</a>
            </div>

            <p style="margin-top:20px;">If you did not expect this email, you can safely ignore it.</p>

            <p style="margin-top:25px;">Thanks,<br><strong>{{ $gs->title }} Team</strong></p>
        </div>

        <!-- Footer -->
        <div class="card-footer">
            © {{ date('Y') }} {{ $gs->title }}. All rights reserved.
        </div>
    </div>

</body>
</html>
