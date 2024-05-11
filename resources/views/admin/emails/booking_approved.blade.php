<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Booking Approved</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        .bg-gray-100 {
            background-color: #f7f7f7;
        }

        .text-gray-800 {
            color: #333;
        }

        .text-gray-600 {
            color: #666;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container">
        <!-- Header dengan logo -->
        <div class="text-center my-4">
            <img src="{{ asset('img/mara/logo1.png') }}" class="py-2 px-2 bg-secondary"
                style="width: 120px; height: 50px; border-radius: 2.5px;" alt="logo">
        </div>

        <!-- Informasi pemesanan -->
        <div class="mb-5 text-center">
            <h1 class="h4 fw-bold text-gray-800">Hallo, {{ $booking->user->name }} !</h1>
            <h1 class="h4 fw-bold text-gray-800">Kami ingin mengucapkan terima kasih atas pemesanan Paket Foto di Mara
                Studio dengan paket
                {{ $booking->photo_package->name }} pada tanggal
                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }}. Kami sangat menghargai kepercayaan
                Anda kepada kami.</h1>
            <p class="text-gray-600">
                Pemesanan ID: {{ $booking->id }}
            </p>
            <p class="text-gray-600">
                Nama Paket: {{ $booking->photo_package->name }}
            </p>
            <p class="text-gray-600">
                Status pemesanan: {{ $booking->status }}
            </p>
            <p class="text-gray-600">
                Tanggal pemesanan: {{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }}
            </p>
            <p class="text-gray-600">
                Total harga: Rp {{ number_format($booking->price, 2) }}
            </p>
        </div>

        <!-- Informasi lebih lanjut atau detail lain -->
        <div class="card bg-white shadow-md p-4 rounded-3xl mb-5">
            <p class="text-gray-600 text-center">
                Jika Anda memiliki pertanyaan, silakan hubungi kami di
                <a class="text-dark" href="marakreatif@gmail.com">marakreatif@gmail.com</a> atau <a class="text-dark"
                    href="https://api.whatsapp.com/send/?phone=6285876947844&text&type=phone_number&app_absent=0">wa.me/6285876947844</a>
            </p>
        </div>
    </div>
</body>

</html>
