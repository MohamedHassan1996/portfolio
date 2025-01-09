<!DOCTYPE html>
<html>
<head>
    <title>Newsletter Subscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #007BFF;
        }
        .content {
            text-align: left;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            text-align: center;
            color: #888;
        }
        .unsubscribe {
            text-decoration: none;
            color: #ffffff;
            background: #d9534f;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Our Newsletter!</h1>
        </div>
        <div class="content">
            <p>Hi,</p>
            <p>Thank you for subscribing to our newsletter. We're excited to keep you updated with our latest news and promotions!</p>
            <p>If you ever wish to unsubscribe, you can do so by clicking the button below:</p>
            <p>
                <a href="{{ url('api/v1/subscribers/delete?email=' . urlencode($email) . '&token=' . $unsubscribeToken) }}" class="unsubscribe">
                    Unsubscribe
                </a>
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
