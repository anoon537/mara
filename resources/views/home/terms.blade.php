@extends('layouts.app1') <!-- Layout utama -->

@section('title', 'Terms & Conditions - Mara Studio')

@section('content')
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow" role="status"></div>
    </div>
    <nav class="navbar navbar-expand-lg bg-white navbar-light fixed-top shadow py-lg-0 px-4 px-lg-5 wow fadeIn"
        data-wow-delay="0.1s">
        @include('layouts.navbar')
    </nav>
    <div class="container mt-5 pt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('homepage') }}" class="text-secondary">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="text-secondary">Terms & Conditions</span>
                </li>
            </ol>
        </nav>
        <div class="container my-5">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-center mb-4">Syarat dan Ketentuan</h1>

                    <h3>Pendahuluan</h3>
                    <p>Hai, selamat datang di Mara Studio! Syarat dan ketentuan ini dibuat supaya kita semua nyaman dan
                        paham aturan yang ada di Mara Studio.</p>

                    <h3>Layanan Kami</h3>
                    <p>Kami di Mara Studio menyediakan berbagai layanan fotografi profesional, seperti sesi foto, wedding,
                        prewedding, group, self photo, graduation, family, engagement, birthday, dll. Detail layanan bisa
                        Anda cek di website atau tanya langsung ke kami.</p>

                    <h3>Pemesanan dan Pembayaran</h3>
                    </p>
                    <p><strong>Pembayaran:</strong> Pembayaran bisa dilakukan lewat transfer bank ke rekening berikut:</p>
                    <ul>
                        <li><strong>Bank:</strong> BCA</li>
                        <li><strong>Nomor Rekening:</strong> 123-456-789</li>
                        <li><strong>Atas Nama:</strong> John Doe</li>
                    </ul>
                    <p><strong>DP:</strong> DP sebesar 50% dari total biaya sesi diperlukan untuk mengamankan booking Anda.
                        Sisa pembayaran harus dibayar sebelum atau pada hari sesi.</p>
                    <p><strong>Pembayaran Penuh:</strong> Anda juga bisa langsung bayar penuh di awal.</p>

                    <h3>Pembatalan dan Pengembalian Dana</h3>
                    <p><strong>Pembatalan:</strong> Jika terjadi pembatalan sepihak, maka pelunasan yang sudah di bayar
                        tidak dapat di kembalikan.</p>
                    <p><strong>Pengembalian Dana:</strong> Pengembalian dana hanya bisa dilakukan jika sesi dibatalkan oleh
                        Mara Studio karena alasan tertentu.</p>

                    <h3>Hak Penggunaan</h3>
                    <p><strong>Penggunaan oleh Klien:</strong> Anda bisa pakai foto-foto untuk keperluan pribadi, seperti
                        posting di media sosial atau cetak untuk pribadi.</p>
                    <p><strong>Penggunaan oleh Mara Studio:</strong> Kami berhak pakai foto-foto untuk keperluan
                        promosi, seperti portofolio, website, media sosial, dan materi pemasaran. Jika tidak mau fotonya
                        dipakai, mohon konfirmasi ke kami.</p>

                    <h3>Tanggung Jawab</h3>
                    <p><strong>Penyediaan Layanan:</strong> Kami berusaha memberikan foto terbaik, tapi kami tidak
                        bertanggung jawab jika Anda kurang puas dengan hasilnya.</p>
                    <p><strong>Kerusakan atau Kehilangan:</strong> Kami tidak bertanggung jawab atas kerusakan atau
                        kehilangan barang pribadi selama sesi foto.</p>

                    <h3>Kebijakan Privasi</h3>
                    <p>Kami di Mara Studio menghargai privasi Anda dan berkomitmen untuk melindungi informasi pribadi
                        Anda. Data pribadi yang kami kumpulkan selama proses booking hanya digunakan untuk layanan fotografi
                        dan tidak akan dibagikan ke pihak ketiga tanpa izin Anda.</p>

                    <h3>Hukum yang Berlaku</h3>
                    <p>Syarat dan ketentuan ini diatur oleh hukum yang berlaku. Jika ada perselisihan, akan diselesaikan ke
                        pihak yang berwenang.</p>

                    <h3>Informasi Kontak</h3>
                    <p>jika Anda punya pertanyaan atau kekhawatiran tentang syarat dan ketentuan ini, silakan hubungi kami
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

                    <p>Dengan booking sesi foto di Mara Studio, Anda mengakui bahwa Anda sudah membaca, memahami, dan
                        setuju dengan syarat dan ketentuan ini.</p>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
