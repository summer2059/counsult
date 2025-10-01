<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
    <style>
        :root {
            --primary: #F3525A;
            --secondary: #F6F6F6;
            --light: #FFFFFF;
            --dark: #152440;
        }

        body {
            font-family: 'Barlow', sans-serif;
            background-color: var(--secondary);
            margin: 0;
            padding: 0;
            color: var(--dark);
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: var(--light);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .header {
            background-color: var(--primary);
            padding: 20px;
            text-align: center;
            color: white;
        }

        .header h2 {
            margin: 0;
            font-weight: 700;
        }

        .content {
            padding: 30px;
        }

        .content h4 {
            margin-top: 0;
            color: var(--primary);
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .info-table td {
            padding: 10px;
            vertical-align: top;
        }

        .info-table td.label {
            font-weight: 600;
            color: var(--primary);
            width: 150px;
        }

        .footer {
            padding: 20px;
            text-align: center;
            font-size: 14px;
            background-color: #f0f0f0;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>
                {{ $data['form_name'] ?? config('app.name') }} – {{ $data['subject'] }}
            </h2>
            <h2>📨 New Contact Message</h2>
        </div>

        <div class="content">
            <h4>You've received a new contact message:</h4>

            <table class="info-table">
                <tr>
                    <td class="label">Name:</td>
                    <td>{{ $data['name'] }}</td>
                </tr>
                <tr>
                    <td class="label">Email:</td>
                    <td>{{ $data['email'] }}</td>
                </tr>
                <tr>
                    <td class="label">Subject:</td>
                    <td>{{ $data['subject'] }}</td>
                </tr>
                <tr>
                    <td class="label">Message:</td>
                    <td>{{ $data['message'] }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            This message was generated from the contact form on Chandra Consultancy.
        </div>
    </div>
</body>
</html>
