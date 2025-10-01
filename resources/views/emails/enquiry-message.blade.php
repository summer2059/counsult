<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>New Enquiry Message</title>
    <style>
        /* Internal CSS for email - simplified for compatibility */

        :root {
            --primary: #F3525A;
            --secondary: #F6F6F6;
            --light: #FFFFFF;
            --dark: #152440;
        }

        body {
            font-family: 'Barlow', sans-serif, Arial, sans-serif;
            background-color: var(--secondary);
            color: var(--dark);
            margin: 0;
            padding: 0;
        }

        .email-wrapper {
            max-width: 600px;
            margin: 30px auto;
            background: var(--light);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 30px;
        }

        h1 {
            color: var(--primary);
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 15px;
            text-align: center;
        }

        p, li {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        ul.details {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        ul.details li {
            background: var(--secondary);
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 12px;
            font-weight: 600;
            color: var(--dark);
        }

        .footer {
            font-size: 14px;
            color: #666666;
            text-align: center;
            margin-top: 30px;
        }

        .footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <h1>{{ $data['form_name'] ?? 'Enquiry Form' }}</h1>

        <p>You have received a new enquiry with the following details:</p>

        <ul class="details">
            <li><strong>Name:</strong> {{ $data['name'] }}</li>
            <li><strong>Email:</strong> {{ $data['email'] }}</li>
            <li><strong>Phone:</strong> {{ $data['phone'] }}</li>
            <li><strong>Address:</strong> {{ $data['address'] }}</li>
            <li><strong>Service:</strong> {{ $data['service_name'] ?? 'N/A' }}</li>
        </ul>

        <p>Thanks,<br>Chandra Teams</p>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Chandra Teams. All rights reserved.
    </div>
</body>
</html>
