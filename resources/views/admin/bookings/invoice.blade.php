<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body onload="window.print();">
    <div class="card">
        <div class="card-body mx-4">
            <div class="container">
                <p class="my-5 mx-5" style="font-size: 30px;">Thank you for your purchase</p>
                <div class="row">
                    <ul class="list-unstyled">
                        <li class="text-black">{{ $booking->user->name }}</li>
                        <li class="text-muted mt-1"><span class="text-black">Invoice</span> #{{ $booking->id }}</li>
                        <li class="text-black mt-1">{{ $booking->booking_date }}</li>
                    </ul>
                    <hr>
                    <!-- Daftar paket foto -->
                    <div class="row">
                        <div class="col-xl-10">
                            <p>{{ $booking->photo_package->name }}</p>
                        </div>
                        <div class="col-xl-2">
                            <p class="float-end">{{ number_format($booking->price, 2) }}</p>
                        </div>
                        <hr style="border: 2px solid black;">
                    </div>
                    <!-- Total harga -->
                    <div class="row text-black">
                        <div class="col-xl-12">
                            <p class="float-end fw-bold">Total: {{ number_format($booking->price, 2) }}</p>
                        </div>
                        <hr style="border: 2px solid black;">
                    </div>
                    <!-- Catatan tambahan -->
                    <div class="text-center" style="margin-top: 90px;">
                        <p>Terima kasih telah menggunakan layanan kami!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
