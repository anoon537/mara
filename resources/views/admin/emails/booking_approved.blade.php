<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Booking Approved</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<body class="bg-body-tertiary">
    <div class="container">
        <!-- Header with logo -->
        <div class="text-center my-4">
            <img src="{{ asset('img/mara/logo1.png') }}" class="py-2 px-2 bg-secondary"
                style="width: 120px; height: 50px; border-radius: 2.5px;" alt="logo">
        </div>

        <!-- Booking Information -->
        <div class="my-5 text-center">
            <h1 class="text-secondary">Hello, {{ $booking->user->name }}!</h1>
            <h4 class="text-secondary">We would like to thank you for booking a Photo Package at Mara Studio with the
                package
                {{ $booking->photo_package->name }} on
                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }} at
                {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}. We truly appreciate
                your trust in us.</h4>
            <p class="text-black-50">
                Booking ID: <span class="text-black">{{ $booking->id }}</span>
            </p>
            <p class="text-black-50">
                Package Name: <span class="text-black">{{ $booking->photo_package->name }}</span>
            </p>
            <p class="text-black-50">
                Price: <span class="text-black">Rp.{{ number_format($booking->price, 0, ',', '.') }}</span>
            </p>
            <p class="text-black-50">
                Booking Date & Time: <span
                    class="text-black">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }} at
                    {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }} WIB</span>
            </p>
            <p class="text-black-50">
                Booking Status: <span class="text-black">{{ $booking->status }}</span>
            </p>
            <p class="text-black-50">
                Payment: <span class="text-black">Rp.{{ number_format($booking->payment->price, 0, ',', '.') }} |
                    {{ $booking->payment->payment_option }}</span>
            </p>
            <p class="text-black-50">
                You have an outstanding payment of
                <span
                    class="text-black">Rp.{{ number_format($booking->price - $booking->payment->price, 0, ',', '.') }}</span>
            </p>
        </div>

        <!-- Further Information or Other Details -->
        <div class="card bg-white shadow-md p-4 rounded-3xl mb-5">
            <p class="text-secondary-emphasis text-center fw-bold">
                Please arrive on time according to the booked date and time. If you have any questions, please contact
                us at <a class="text-success"
                    href="https://api.whatsapp.com/send/?phone=6285876947844&text&type=phone_number&app_absent=0">wa.me/6285876947844</a>
                or <a class="text-info-emphasis" href="marakreatif@gmail.com">marakreatif@gmail.com</a>
            </p>
        </div>
    </div>
</body>


</html>
