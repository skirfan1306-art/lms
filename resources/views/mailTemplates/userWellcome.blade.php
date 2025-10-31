<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to {{ $gs->title }}</title>
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
      <h2 style="margin:0;">Welcome to {{ $gs->title }}</h2>
    </div>

    <!-- Body -->
    <div class="card-body">
      <p>Hello {{ $userName ?? 'User' }},</p>
      <p>We’re excited to have you join <strong>{{ $gs->title }}</strong>!  
      Your account has been successfully created. Click the button below to log in and start exploring:</p>
      
      <div style="text-align:center;">
        <a href="{{ $loginUrl ?? '#' }}" class="btn-primary">Get Started</a>
      </div>

      <p style="margin-top:25px;">Cheers,<br><strong>{{ $gs->title }} Team</strong></p>
    </div>

    <!-- Footer -->
    <div class="card-footer">
      © {{ date('Y') }} {{ $gs->title }}. All rights reserved.
    </div>
  </div>

</body>
</html>
