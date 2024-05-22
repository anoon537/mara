@extends('layouts.app1') <!-- Layout utama -->
@section('title')
    {{ $package->name }} - Photo Package
@endsection

@section('content')
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow" role="status"></div>
    </div>
    <!-- Spinner End -->
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light fixed-top shadow py-lg-0 px-4 px-lg-5 wow fadeIn"
        data-wow-delay="0.1s">
        @include('layouts.navbar')
    </nav>
    <!-- Navbar End -->

    <!-- Detail Paket Foto -->
    <div class="container mt-5 pt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li> <!-- Tampilkan setiap error -->
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Breadcrumbs untuk navigasi -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('produk') }}" class="text-secondary">Photo Packages</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $package->name }}</li>
            </ol>
        </nav>
        <div class="row">
            <!-- Gambar Utama -->
            <div class="col-md-6 text-center mt-5">
                <img src="{{ $package->image_url }}" alt="{{ $package->name }}" class="img-fluid rounded"
                    style="height: 500px; object-fit: cover;">
            </div>

            <!-- Informasi dan Harga -->
            <div class="col-md-6 mt-5">
                <h2 class="fw-bold">{{ $package->name }}</h2>
                <h2 class="fw-bold text-muted" style="font-size: 2rem;">Rp.
                    {{ number_format($package->price, 0, ',', '.') }}</h2>

                <!-- Deskripsi sebagai daftar -->
                <ul>
                    @foreach ($descriptionArray as $descItem)
                        <li>{{ trim($descItem) }}</li> <!-- Hilangkan spasi tambahan -->
                    @endforeach
                    <!-- Tombol menuju galeri -->
                    @php
                        // Logika untuk menentukan ID anchor galeri
                        $packageNameLower = strtolower($package->name);
                        if (str_contains($packageNameLower, 'graduation')) {
                            $galleryTitle = 'graduation';
                        } elseif (str_contains($packageNameLower, 'wedding')) {
                            $galleryTitle = 'wedding';
                        } elseif (str_contains($packageNameLower, 'prewedding')) {
                            $galleryTitle = 'prewedding';
                        } elseif (str_contains($packageNameLower, 'family')) {
                            $galleryTitle = 'family';
                        } elseif (str_contains($packageNameLower, 'engagement')) {
                            $galleryTitle = 'engagement';
                        } elseif (str_contains($packageNameLower, 'group')) {
                            $galleryTitle = 'group';
                        } else {
                            $galleryTitle = 'default';
                        }
                        $galleryUrl = url('/galery') . '#' . $galleryTitle;
                    @endphp
                    <a href="{{ $galleryUrl }}" class="text-secondary me-2">View More Photos</a>
                </ul>
                <p class="text-muted me-1">*Mohon membaca S&K sebelum melakukan pembayaran. <a href="#" type="submit"
                        class="text-secondary" data-bs-toggle="modal" data-bs-target="#termsModal">Terms
                        &
                        Conditions</a></p>
                <!-- Tombol untuk booking -->
                <button class="btn btn-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#bookingModal">Book
                    Now</button>
            </div>
        </div>

        <!-- Modal untuk booking -->
        <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookingModalLabel">Book {{ $package->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulir booking -->
                        <form action="{{ route('booking.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="package_id" value="{{ $package->id }}">

                            <!-- Nama Pengguna -->
                            <div class="mb-3">
                                <label for="user_name">Name</label>
                                <input type="text" name="user_name" id="user_name" class="form-control"
                                    value="{{ isset($user) ? $user->name : '' }}" readonly>
                            </div>

                            <!-- Nomor Telepon -->
                            <div class="mb-3">
                                <label for="user_phone">Phone</label>
                                <input type="text" name="user_phone" id="user_phone" class="form-control"
                                    value="{{ isset($user) ? $user->phone : '' }}" readonly>
                            </div>

                            <!-- Tanggal -->
                            <div class="mb-3">
                                <label for="booking_date">Date</label>
                                <input type="date" name="booking_date" id="booking_date" class="form-control" required>
                            </div>

                            <!-- Waktu -->
                            <div class="mb-3">
                                <label for="booking_time">Time</label>
                                <select name="booking_time" id="booking_time" class="form-control" required>
                                    <option value="">Select Time</option>
                                    <!-- Waktu yang belum terbooking -->
                                    @for ($hour = 9; $hour <= 18; $hour++)
                                        @php
                                            $timeSlot = sprintf('%02d:00', $hour);
                                        @endphp
                                        @if (!in_array($timeSlot, $existingBookings))
                                            <option value="{{ $timeSlot }}">{{ $timeSlot }} -
                                                {{ sprintf('%02d:00', $hour + 1) }}</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="additional_people">Extra Person? Rp.15.000,-/person<span
                                        class="text-muted mx-1">(Optional)</span></label>
                                <input type="number" name="additional_people" id="additional_people" min="0"
                                    step="1" class="form-control" value="0">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree with <a href="{{ route('terms-conditions') }}" target="_blank"
                                        class="text-muted">Terms &
                                        Conditions</a>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-secondary">Book Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Terms -->
        <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="termsModalLabel">Terms & Conditions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <h3>Pendahuluan</h3>
                        <p>Hai, selamat datang di Mara Studio! Syarat dan ketentuan ini dibuat supaya kita semua
                            nyaman dan
                            paham aturan yang ada di Mara Studio.</p>

                        <h3>Layanan Kami</h3>
                        <p>Kami di Mara Studio menyediakan berbagai layanan fotografi profesional, seperti sesi
                            foto, wedding,
                            prewedding, group, self photo, graduation, family, engagement, birthday, dll. Detail
                            layanan bisa
                            Anda cek di website atau tanya langsung ke kami.</p>

                        <h3>Pemesanan dan Pembayaran</h3>
                        </p>
                        <p><strong>Pembayaran:</strong> Pembayaran bisa dilakukan lewat transfer bank ke rekening
                            berikut:</p>
                        <ul>
                            <li><strong>Bank:</strong> BCA</li>
                            <li><strong>Nomor Rekening:</strong> 123-456-789</li>
                            <li><strong>Atas Nama:</strong> John Doe</li>
                        </ul>
                        <p><strong>DP:</strong> DP sebesar 50% dari total biaya sesi diperlukan untuk mengamankan
                            booking Anda.
                            Sisa pembayaran harus dibayar sebelum atau pada hari sesi.</p>
                        <p><strong>Pembayaran Penuh:</strong> Anda juga bisa langsung bayar penuh di awal.</p>

                        <h3>Pembatalan dan Pengembalian Dana</h3>
                        <p><strong>Pembatalan:</strong> Jika terjadi pembatalan sepihak, maka pelunasan yang sudah
                            di bayar
                            tidak dapat di kembalikan.</p>
                        <p><strong>Pengembalian Dana:</strong> Pengembalian dana hanya bisa dilakukan jika sesi
                            dibatalkan oleh
                            Mara Studio karena alasan tertentu.</p>

                        <h3>Hak Penggunaan</h3>
                        <p><strong>Penggunaan oleh Klien:</strong> Anda bisa pakai foto-foto untuk keperluan
                            pribadi, seperti
                            posting di media sosial atau cetak untuk pribadi.</p>
                        <p><strong>Penggunaan oleh Mara Studio:</strong> Kami berhak pakai foto-foto untuk keperluan
                            promosi, seperti portofolio, website, media sosial, dan materi pemasaran. Jika tidak mau
                            fotonya
                            dipakai, mohon konfirmasi ke kami.</p>

                        <h3>Tanggung Jawab</h3>
                        <p><strong>Penyediaan Layanan:</strong> Kami berusaha memberikan foto terbaik, tapi kami
                            tidak
                            bertanggung jawab jika Anda kurang puas dengan hasilnya.</p>
                        <p><strong>Kerusakan atau Kehilangan:</strong> Kami tidak bertanggung jawab atas kerusakan
                            atau
                            kehilangan barang pribadi selama sesi foto.</p>

                        <h3>Kebijakan Privasi</h3>
                        <p>Kami di Mara Studio menghargai privasi Anda dan berkomitmen untuk melindungi informasi
                            pribadi
                            Anda. Data pribadi yang kami kumpulkan selama proses booking hanya digunakan untuk
                            layanan fotografi
                            dan tidak akan dibagikan ke pihak ketiga tanpa izin Anda.</p>

                        <h3>Hukum yang Berlaku</h3>
                        <p>Syarat dan ketentuan ini diatur oleh hukum yang berlaku. Jika ada perselisihan, akan
                            diselesaikan ke
                            pihak yang berwenang.</p>

                        <h3>Informasi Kontak</h3>
                        <p>jika Anda punya pertanyaan atau kekhawatiran tentang syarat dan ketentuan ini, silakan
                            hubungi kami
                            di:</p>
                        <ul>
                            <li><strong>Email:</strong> marakreatif@gmail.com</li>
                            <li><strong>Telepon:</strong>
                                <a rel="stylesheet" href="https://wa.me/6285876947844"> 085876947844
                                </a>
                            </li>
                            <li><strong>Instagram:</strong><a href="https://www.instagram.com/marastudio_id/">
                                    @marastudio_id</a>
                            </li>
                        </ul>

                        <p>Dengan booking sesi foto di Mara Studio, Anda mengakui bahwa Anda sudah membaca,
                            memahami, dan
                            setuju dengan syarat dan ketentuan ini.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
