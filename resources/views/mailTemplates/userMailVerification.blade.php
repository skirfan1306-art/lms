<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Verification</title>
  <style>
    body {
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
      font-family: Arial, sans-serif;
      color: #212529;
    }
    .card {
      max-width: 600px;
      margin: 20px auto;
      border: 1px solid #dee2e6;
      border-radius: .5rem;
      box-shadow: 0 4px 8px rgba(0,0,0,.05);
      background-color: #ffffff;
      overflow: hidden;
    }
    .card-header {
      background-color: #354F52;
      color: #ffffff;
      padding: 20px;
      text-align: center;
    }
    .card-header img.logo {
      max-width: 140px;
      height: auto;
      margin-bottom: 10px;
    }
    .card-body {
      padding: 30px;
      font-size: 15px;
      line-height: 1.6;
    }
    .btn-primary {
      display: inline-block;
      padding: 12px 24px;
      font-size: 16px;
      font-weight: bold;
      color: #ffffff;
      background-color: #354F52;
      border-radius: .5rem;
      text-decoration: none;
      margin: 20px 0;
    }
    .btn-primary:hover {
      background-color: #2b3e41;
    }
    .card-footer {
      background-color: #f8f9fa;
      padding: 15px;
      text-align: center;
      font-size: 13px;
      color: #6c757d;
    }
  </style>
</head>
<body>

  <div class="card">
    <!-- Header -->
    <div class="card-header">
      <img src="{{ asset('assets/logo/' . $gs->footer_logo) }}" alt="{{ $gs->title }}" class="logo"><br>
      <h2 style="margin:0;">Verify Your Email</h2>
    </div>

    <!-- Body -->
    <div class="card-body">
      <p>Hello {{ $userName ?? 'User' }},</p>
      <p>Your account has been created successfully! Please click the button below to verify your email address and activate your account:</p>
      
      <div style="text-align:center;">
        <a href="{{ $verificationUrl ?? '#' }}" class="btn-primary">Verify Email</a>
      </div>

      <p style="margin-top:20px;">If you didn’t sign up for {{ $gs->title }}, you can safely ignore this message.</p>

      <p style="margin-top:25px;">Thanks,<br><strong>{{ $gs->title }} Team</strong></p>
    </div>

    <!-- Footer -->
    <div class="card-footer">
      © {{ date('Y') }} {{ $gs->title }}. All rights reserved.
    </div>
  </div>

</body>
</html>
