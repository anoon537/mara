@extends('admin.layouts.app')

@section('content')
    <div class="container py-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="container-fluid p-4 rounded shadow-lg" style="background-color: #fefeff;">
            <form action="{{ route('admin.do.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="paket">Paket</label>
                    <input type="text" name="paket" id="paket" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="harga">Harga</label>
                    <input type="number" id="harga" name="harga" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="extra_person">Extra Person <span class="text-muted">(optional)</span></label>
                    <input type="number" name="extra_person" id="extra_person" class="form-control" value="0">
                </div>

                <div class="mb-3">
                    <label for="booking_date">Booking Date</label>
                    <input type="date" name="booking_date" id="booking_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="booking_time">Booking Time</label>
                    <select name="booking_time" id="booking_time" class="form-control" required>
                        @for ($hour = 9; $hour < 18; $hour++)
                            <option value="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00">
                                {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00 -
                                {{ str_pad($hour + 1, 2, '0', STR_PAD_LEFT) }}:00
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label for="payment_type">Payment Type</label>
                    <select name="payment_type" id="payment_type" class="form-control" required>
                        <option value="full">Full Payment</option>
                        <option value="dp">DP</option>
                    </select>
                    <div class="mt-3" id="dp_amount_wrapper" style="display:none;">
                        <label for="dp_amount">DP Amount</label>
                        <input type="number" id="dp_amount" name="dp_amount" class="form-control"
                            placeholder="Enter DP amount" min="0">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.do.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('payment_type').addEventListener('change', function() {
            var paymentType = this.value;
            var dpWrapper = document.getElementById('dp_amount_wrapper');

            if (paymentType === 'dp') {
                dpWrapper.style.display = 'block';
            } else {
                dpWrapper.style.display = 'none';
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const extraPersonInput = document.getElementById('extra_person');
            const hargaInput = document.getElementById('harga');
            const extraPersonCost = 20000; // Biaya per orang tambahan

            // Fungsi untuk memperbarui harga
            function updatePrice() {
                const extraPersonCount = parseInt(extraPersonInput.value);
                let hargaAwal = parseInt(hargaInput.getAttribute('data-original-price')) || parseInt(hargaInput
                    .value); // Ambil harga awal dari input atau set ke atribut data
                let totalPrice = hargaAwal + (extraPersonCost * extraPersonCount);

                if (extraPersonCount > 0) {
                    hargaInput.value = totalPrice;
                    hargaInput.setAttribute('readonly', true); // Disable input
                } else {
                    hargaInput.removeAttribute('readonly'); // Enable input jika extra person 0
                    hargaInput.value = hargaAwal; // Kembalikan harga awal
                }
            }

            // Set harga awal sebagai atribut data pada input harga
            hargaInput.addEventListener('input', function() {
                hargaInput.setAttribute('data-original-price', hargaInput.value);
            });

            // Event listener untuk update harga ketika extra person berubah
            extraPersonInput.addEventListener('input', updatePrice);
        });
        traPersonInput.addEventListener('input', updatePrice);
    </script>
@endsection
