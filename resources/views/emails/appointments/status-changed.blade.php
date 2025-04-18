<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Status Update</title>
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
        .appointment-details {
            background-color: #fff;
            border: 1px solid #eee;
            border-radius: 5px;
            padding: 15px;
            margin-top: 15px;
        }
        .appointment-details p {
            margin: 5px 0;
        }
        .status-accepted {
            color: #28a745;
            font-weight: bold;
        }
        .status-rejected {
            color: #dc3545;
            font-weight: bold;
        }
        .status-cancelled {
            color: #6c757d;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Appointment Status Update</h2>
        </div>
        <div class="content">
            <p>Hello {{ ucfirst($appointment->student->Fname) }} {{ ucfirst($appointment->student->LName) }},</p>
            
            <p>Your appointment status has been updated to 
                <span class="status-{{ $status }}">{{ ucfirst($status) }}</span>
            </p>
            
            <div class="appointment-details">
                <h3>Appointment Details:</h3>
                <p><strong>Date and Time:</strong> {{ $appointment->app_date->format('F j, Y, g:i a') }}</p>
                <p><strong>Status:</strong> {{ ucfirst($status) }}</p>
                <p><strong>Advisor:</strong> {{ ucfirst($appointment->advisor->fName) }} {{ ucfirst($appointment->advisor->lName) }}</p>
            </div>
            
            @if($status == 'accepted')
                <p>Please make sure to attend your appointment on time.</p>
            @elseif($status == 'rejected')
                <p>You can request a new appointment at a different time through the AdviseMate portal.</p>
            @endif
            
            <p>Thank you for using AdviseMate!</p>
        </div>
        <div class="footer">
            <p>This is an automated message, please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} AdviseMate. All rights reserved.</p>
        </div>
    </div>
</body>
</html> 