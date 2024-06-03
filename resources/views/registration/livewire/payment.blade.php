<div>
    @php
        $disabled = false;
        if ($status == 'pendaftaran berhasil') {
            $disabled = true;
        }
    @endphp
    <div class="w-100 border rounded-1 px-4 py-4 my-5">
        <h3 class="text-center mb-4">Informasi Pembayaran</h3>
        <div class="row mb-3 mt-2">
            <div class="col-12 col-sm-6">
                <x-input name="namaAkun" label="Nama Akun Pembayaran" disabled="{{ $disabled }}" />
            </div>
            <div class="col-12 col-sm-6">
                <x-input name="pricePayment" type="tel" label="Jumlah Pembayaran" disabled="{{ $disabled }}" />
            </div>
            <div class="col-12">
                <x-input name="proofPayment" label="Bukti Pembayaran ( gambar )" type="file" disabled="{{ $disabled }}" />
                @if (!empty($proofPaymentHad))
                <div id="proofPayment" class="form-text"><a href="{{ asset($proofPaymentHad) }}" target="_blank">Klik
                    Disini Untuk Review Bukti Pembayaran</a></div>
                @endif

                <div wire:loading wire:target="proofPayment">
                    Loading Upload Image
                </div>
            </div>
        </div>
        @if (!$disabled)
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-primary rounded-pill" wire:click="updatePayment" wire:loading.attr="disabled">Kirim</button>
            </div>
        @endif

    </div>

</div>
