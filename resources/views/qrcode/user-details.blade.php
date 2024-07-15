<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        .qrcode-container {
            text-align: center;
            margin-top: 50px;
        }
        .user-details {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            width: 300px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="qrcode-container">
        <h1>User Details</h1>
        <div class="user-details">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <!-- Add more user details as needed -->
        </div>
    </div>
</body>
</html>
