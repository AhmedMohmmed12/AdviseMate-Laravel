<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Support Ticket Created</title>
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
        .ticket-details {
            background-color: #fff;
            border: 1px solid #eee;
            border-radius: 5px;
            padding: 15px;
            margin-top: 15px;
        }
        .ticket-details p {
            margin: 5px 0;
        }
        .ticket-description {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 3px;
            margin-top: 10px;
            white-space: pre-line;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Support Ticket Created</h2>
        </div>
        <div class="content">
            <p>Hello {{ ucfirst($ticket->student->Fname) }} {{ ucfirst($ticket->student->LName) }},</p>
            
            <p>Your support ticket has been created successfully and is awaiting response.</p>
            
            <div class="ticket-details">
                <h3>Ticket Details:</h3>
                <p><strong>Ticket Type:</strong> {{ $ticket->ticketType->ticket_type }}</p>
                <p><strong>Status:</strong> Pending</p>
                <p><strong>Created on:</strong> {{ $ticket->created_at->format('F j, Y, g:i a') }}</p>
                <p><strong>Description:</strong></p>
                <div class="ticket-description">{{ $ticket->ticket_description }}</div>
            </div>
            
            <p>Your advisor will review your ticket soon. You will receive another email when there's an update.</p>
            
            <p>Thank you for using AdviseMate!</p>
        </div>
        <div class="footer">
            <p>This is an automated message, please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} AdviseMate. All rights reserved.</p>
        </div>
    </div>
</body>
</html> 