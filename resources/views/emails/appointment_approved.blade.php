@php
    // Determine recipient type
    $recipientIsTherapist = isset($recipientEmail) && $recipientEmail === $appointment->therapist->email;

    // Format date and time
    $date = \Carbon\Carbon::createFromFormat('Y-m-d', $appointment->date)->format('d-m-Y');
    [$startTime, $endTime] = explode('-', $appointment->slot);
    $start = \Carbon\Carbon::createFromFormat('H:i', $startTime)->format('h:i A');
    $end = \Carbon\Carbon::createFromFormat('H:i', $endTime)->format('h:i A');
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CasaEarth Appointment</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f6f6f6; padding: 20px;">
    <div style="max-width: 600px; background: white; margin: auto; border-radius: 8px; overflow: hidden;">
        <div style="background-color: #2575fc; color: white; padding: 15px 20px;">
            <h2>CasaEarth Appointment</h2>
        </div>
        <div style="padding: 20px;">

            @if($recipientIsTherapist)
                <p>Hello {{ $appointment->therapist->name ?? 'Therapist' }},</p>
                <p>You've got a CasaEarth appointment scheduled with <strong>{{ $appointment->user->name ?? 'Client' }}</strong>.</p>
            @else
                <p>Hello {{ $appointment->user->name ?? 'Client' }},</p>
                <p>Your therapy appointment with <strong>{{ $appointment->therapist->name ?? 'Therapist' }}</strong> has been approved!</p>
            @endif

            <p><strong>Date:</strong> {{ $date }}</p>
            <p><strong>Time Slot:</strong> {{ $start }} - {{ $end }}</p>

            @if(!empty($meetLink))
                <p>You can join the session using this Google Meet link:</p>
                <p>
                    <a href="{{ $meetLink }}" style="display:inline-block;background-color:#2575fc;color:white;padding:10px 15px;border-radius:5px;text-decoration:none;">
                        Join Meeting
                    </a>
                </p>
            @endif

            <p>If you have any questions, feel free to reply to this email.</p>
            <p>Thank you,<br>CasaEarth Team</p>
        </div>
    </div>
</body>
</html>
