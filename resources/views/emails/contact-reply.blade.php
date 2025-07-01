<!DOCTYPE html>
<html>

<head>
    <title>Reply to Your Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
        }

        .content {
            padding: 20px;
        }

        .footer {
            margin-top: 20px;
            font-size: 0.8em;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Reply to Your Message</h2>
        </div>

        <div class="content">
            <p>Hello {{ $contact->name }},</p>

            <p>Thank you for contacting us. Here is our reply to your message:</p>

            <blockquote style="background: #f8f9fa; padding: 10px; border-left: 3px solid #ddd;">
                <p><strong>Your Original Message:</strong></p>
                <p>{{ $contact->message }}</p>
            </blockquote>

            <h3>Our Reply:</h3>
            <p>{{ $reply }}</p>

            <p>If you have any further questions, please don't hesitate to contact us again.</p>
        </div>

        <div class="footer">
            <p>Best regards,</p>
            <p>{{ $appInfo['company_name'] }}</p>
        </div>
    </div>
</body>

</html>
