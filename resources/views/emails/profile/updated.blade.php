<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Updated Successfully</title>
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
        .profile-details {
            background-color: #fff;
            border: 1px solid #eee;
            border-radius: 5px;
            padding: 15px;
            margin-top: 15px;
        }
        .profile-details p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Profile Updated</h2>
        </div>
        <div class="content">
            @if($userType == 'student')
                <p>Hello {{ $user->Fname }} {{ $user->LName }},</p>
            @else
                <p>Hello {{ $user->fName }} {{ $user->lName }},</p>
            @endif
            
            <p>Your profile information has been updated successfully.</p>
            
            <div class="profile-details">
                <h3>Updated Profile Details:</h3>
                @if($userType == 'student')
                    <p><strong>First Name:</strong> {{ $user->Fname }}</p>
                    <p><strong>Last Name:</strong> {{ $user->LName }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Phone Number:</strong> {{ $user->phoneNumber }}</p>
                @else
                    <p><strong>First Name:</strong> {{ $user->fName }}</p>
                    <p><strong>Last Name:</strong> {{ $user->lName }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Phone Number:</strong> {{ $user->mobileNumber }}</p>
                @endif
            </div>
            
            <p>If you did not make these changes, please contact the administrator immediately.</p>
            
            <p>Thank you for using AdviseMate!</p>
        </div>
        <div class="footer">
            <p>This is an automated message, please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} AdviseMate. All rights reserved.</p>
        </div>
    </div>
</body>
</html> 