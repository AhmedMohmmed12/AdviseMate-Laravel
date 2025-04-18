<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Changed Successfully</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            background-color: #4a6fdc;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
        .alert {
            background-color: #fff3cd;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
            border: 1px solid #ffeeba;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Password Changed</h2>
        </div>
        <div class="content">
            @if($userType == 'student')
                <p>Hello {{ ucfirst($user->Fname) }} {{ ucfirst($user->LName) }},</p>
            @else
                <p>Hello {{ ucfirst($user->fName) }} {{ ucfirst($user->lName) }},</p>
            @endif
            
            <p>Your password has been changed successfully.</p>
            
            <div class="alert">
                <p><strong>Security Alert:</strong> If you did not change your password, please contact the administrator immediately and secure your account.</p>
            </div>
            
            <p>For security reasons, if you use the same password on other websites, we recommend changing those as well.</p>
            
            <p>Thank you for using AdviseMate!</p>
        </div>
        <div class="footer">
            <p>This is an automated message, please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} AdviseMate. All rights reserved.</p>
        </div>
    </div>
</body>
</html> 