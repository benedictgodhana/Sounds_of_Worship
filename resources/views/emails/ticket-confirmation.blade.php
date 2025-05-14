<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000;

        }

    </style>
</head>
<body>

<div class="container">
    <p>Hi {{ $ticket->full_name }},</p>

    <p>Your ticket for <strong>{{ $event->name }}</strong> has been generated. The event will take place on <strong>{{ optional($event->event_date)->format('d M Y') }}
</strong> at <strong>{{ $event->location }}</strong>. You have booked a <strong>{{ ucfirst($ticket->ticket_type) }}</strong> ticket, with a quantity of <strong>{{ $ticket->quantity }}</strong>. Your ticket number is <strong>{{ $ticket->ticket_number }}</strong>.</p>

    <p>The payment status is <strong>{{ $ticket->payment_status === 'pending' ? 'Awaiting Payment' : 'Confirmed' }}</strong>.</p>

    @if($ticket->payment_status === 'pending')
    <p>Please complete your payment to secure your ticket.</p>
    @else
    <p>Your ticket is confirmed. Enjoy the event!</p>
    @endif
</div>

</body>
</html>
