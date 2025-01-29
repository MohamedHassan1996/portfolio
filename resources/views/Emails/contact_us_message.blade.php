<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Contact Us Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        .header {
            background: #007BFF;
            color: #ffffff;
            text-align: center;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            font-size: 20px;
        }
        .content {
            padding: 20px;
            font-size: 16px;
            color: #333;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="content">
        <p><strong>Subject:</strong> {{ $subject }}</p>
        <p><strong>Message:</strong>{{ $messageContent }}</p>
    </div>
</div>

</body>
</html>
