<!DOCTYPE html>
<html>
<head>
    <title>New Inquiry Received</title>
</head>
<body >


    <p>New inquiry received from <strong>{{ $contact->name }}</strong> ({{ $contact->email }}).</p>
    <p><strong>Subject:</strong> {{ $contact->subject }}</p>
    <p><strong>Message:</strong> {{ $contact->message }}</p>

    <p>Please respond at your earliest convenience.</p>

</body>
</html>
