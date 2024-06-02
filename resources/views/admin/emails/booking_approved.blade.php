<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Booking Approved</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 150px;
            height: auto;
            border-radius: 2.5px;
        }

        .booking-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .booking-info h1,
        .booking-info h4 {
            color: #343a40;
            margin-bottom: 10px;
        }

        .booking-info p {
            color: #6c757d;
            margin-bottom: 5px;
        }

        .booking-info .text-black {
            color: #000;
        }

        .further-info {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .further-info p {
            color: #6c757d;
            text-align: center;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .further-info a {
            color: #17a2b8;
            text-decoration: none;
        }

        .further-info a:hover {
            text-decoration: underline;
        }

        .further-info .whatsapp {
            color: #28a745;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header with logo -->
        <div class="header">
            <img src="https://i.ibb.co/dpW9NPS/logo1-1.png" alt="Mara Logo">
        </div>

        <!-- Booking Information -->
        <div class="booking-info">
            <h1>Hello, {{ $booking->user->name }}!</h1>
            <h4>We would like to thank you for booking a Photo Package at Mara Studio with the package
                {{ $booking->photo_package->name }} on
                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }} at
                {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}. We truly appreciate your trust in
                us.</h4>
            <p>Booking ID: <span class="text-black">{{ $booking->id }}</span></p>
            <p>Package Name: <span class="text-black">{{ $booking->photo_package->name }}</span></p>
            <p>Price: <span class="text-black">Rp.{{ number_format($booking->price, 0, ',', '.') }}</span></p>
            <p>Booking Date & Time: <span
                    class="text-black">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }} at
                    {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }} WIB</span></p>
            <p>Booking Status: <span class="text-black">{{ $booking->status }}</span></p>
            <p>Payment: <span class="text-black">Rp.{{ number_format($booking->payment->price, 0, ',', '.') }} |
                    {{ $booking->payment->payment_option }}</span></p>
            <p>You have an outstanding payment of <span
                    class="text-black">Rp.{{ number_format($booking->price - $booking->payment->price, 0, ',', '.') }}</span>
            </p>
        </div>

        <!-- Further Information or Other Details -->
        <div class="further-info">
            <p>Please arrive on time according to the booked date and time. If you have any questions, please contact us
                at <a href="https://wa.me/6285876947844" class="whatsapp">+6285876947844</a> or <a
                    href="mailto:marakreatif@gmail.com">marakreatif@gmail.com</a></p>
        </div>
    </div>
</body>

</html>
