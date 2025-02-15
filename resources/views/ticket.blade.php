<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @if (app()->getLocale() == 'en')
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    @else
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style-ar.css')}}">
    @endif
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <x-sidebar>
            
        </x-sidebar>

        <!-- Main Content -->
        <div class="main-content">
            <h1 class="header">Tickets</h1>
            
            <div class="tickets-section">
                <div class="new-ticket">
                    <button class="action-button">
                        <i class="fas fa-plus"></i> Create New Ticket
                    </button>
                </div>
                <ul class="ticket-list">
                    <li class="ticket-item">
                        <div class="ticket-title">
                            Registration Issue
                        </div>
                        <div class="ticket-meta">
                            <span class="status-indicator status-open">Open</span>
                        </div>
                    </li>
                    <li class="ticket-item">
                        <div class="ticket-title">
                            Course Deletion Request
                        </div>
                        <div class="ticket-meta">
                            <span class="status-indicator status-closed">Closed</span>
                        </div>
                    </li>
                    <li class="ticket-item">
                        <div class="ticket-title">
                            Financial Aid Question
                        </div>
                        <div class="ticket-meta">
                            <span class="status-indicator status-open">Open</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
