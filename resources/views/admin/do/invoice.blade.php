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
                        <li class="text-black">{{ $do->name }}</li>
                        <li class="text-muted mt-1"><span class="text-black">Invoice</span> #{{ $do->id }}</li>
                        <li class="text-black mt-1">{{ \Carbon\Carbon::parse($do->booking_date)->format('d F Y') }}</li>
                    </ul>
                    <hr>
                    <!-- Daftar paket foto -->
                    <div class="row">
                        <div class="col-xl-10">
                            <p>{{ $do->paket }} | Extra Person: {{ $do->extra_person }}</p>
                        </div>
                        <div class="col-xl-2">
                            <p class="float-end">{{ number_format($do->harga, 0, ',', '.') }}</p>
                        </div>
                        <hr style="border: 2px solid black;">
                    </div>

                    <!-- Jika ada Extra Person, tampilkan harga -->
                    @if ($do->extra_person > 0)
                        @php
                            // Variabel untuk harga per extra person
                            $price_per_extra_person = 20000; // Contoh: Rp. 50.000 per orang
                            $extra_person_total = $do->extra_person * $price_per_extra_person;
                        @endphp
                        <div class="row">
                            <div class="col-xl-10">
                                <p>Extra Person Fee ({{ $do->extra_person }} person(s))</p>
                            </div>
                            <div class="col-xl-2">
                                <p class="float-end">Rp {{ number_format($extra_person_total, 0, ',', '.') }}</p>
                            </div>
                            <hr style="border: 2px solid black;">
                        </div>
                    @endif

                    <!-- Total harga -->
                    <div class="row text-black">
                        <div class="col-xl-12">
                            @php
                                // Total akhir dengan harga extra person jika ada
                                $total_price = $do->harga + ($do->extra_person > 0 ? $extra_person_total : 0);
                            @endphp
                            <p class="float-end fw-bold">Total: Rp {{ number_format($total_price, 0, ',', '.') }}</p>
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
