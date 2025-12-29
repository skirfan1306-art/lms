<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome Instructor | {{ $gs->title }}</title>
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
    .credentials {
      background-color: #f8f9fa;
      border: 1px dashed #ced4da;
      padding: 15px;
      border-radius: .5rem;
      margin: 20px 0;
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
      <h2 style="margin:0;">Welcome Instructor</h2>
    </div>

    <!-- Body -->
    <div class="card-body">
      <p>Hello {{ $name ?? 'Instructor' }},</p>

      <p>
        We are pleased to welcome you as an <strong>Instructor</strong> at 
        <strong>{{ $gs->title }}</strong>. Your instructor account has been 
        successfully created.
      </p>

      <p>Please find your login credentials below:</p>

      <div class="credentials">
        <p><strong>Login URL:</strong> <a href="{{ route('instructor.login') ?? '#' }}">{{ route('instructor.login') ?? '#' }}</a></p>
        <p><strong>Email / Username:</strong> {{ $email ?? 'your-email@example.com' }}</p>
        <p><strong>Password:</strong> {{ $password ?? '********' }}</p>
      </div>

      <p style="color:#dc3545;">
        ⚠️ For security reasons, we strongly recommend changing your password after your first login.
      </p>

      <div style="text-align:center;">
        <a href="{{ route('instructor.login') ?? '#' }}" class="btn-primary">Login to Instructor Panel</a>
      </div>

      <p style="margin-top:25px;">
        If you have any questions or need assistance, feel free to contact our support team.
      </p>

      <p>
        Best regards,<br>
        <strong>{{ $gs->title }} Team</strong>
      </p>
    </div>

    <!-- Footer -->
    <div class="card-footer">
      © {{ date('Y') }} {{ $gs->title }}. All rights reserved.
    </div>
  </div>

</body>
</html>
