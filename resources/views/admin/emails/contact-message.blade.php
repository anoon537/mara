<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Message</title>
    <!-- Bootstrap CSS jika digunakan -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons jika diperlukan -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .message-container {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .message-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .message-header h2 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .message-meta {
            font-size: 14px;
            color: #6c757d;
        }

        .message-content {
            font-size: 16px;
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="message-container">
            <div class="message-header">
                <h2>New Contact Message</h2>
                <div class="message-meta">
                    <i class="fas fa-clock me-1"></i> {{ date('F j, Y, g:i a') }}
                </div>
            </div>
            <div class="message-content">
                <p><strong>Name:</strong> {{ $validatedData['name'] }}</p>
                <p><strong>Email:</strong> {{ $validatedData['email'] }}</p>
                <p><strong>Subject:</strong> {{ $validatedData['subject'] }}</p>
                <p><strong>Message:</strong></p>
                <p>{{ $validatedData['message'] }}</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
