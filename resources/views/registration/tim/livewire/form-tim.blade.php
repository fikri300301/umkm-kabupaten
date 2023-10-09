<div>
    @php
        $disbaled = false;
        $disbaledStatus = false;
        if ($action == 'update') {
            $disbaled = true;
        }
        if ($status == 'pendaftaran berhasil') {
            $disbaledStatus = true;
        }
    @endphp
    <h3 class="text-center">Informasi TIM</h3>
    <div class="row mb-3">
        <div class="col-12 col-sm-6">
            <x-input name="email" label="Email" type="email" disabled="{{ $disbaledStatus }}" />
        </div>
        <div class="col-12 col-sm-6">
            <x-input name="phone" type="tel" label="Phone" disabled="{{ $disbaledStatus }}" />
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 col-sm-6">
            <x-input name="instansi" label="Instansi" disabled="{{ $disbaledStatus }}" />
        </div>
        <div class="col-12 col-sm-6">
            <x-select name="participant" label="Jumlah Anggota" disabled="{{ $disbaled }}">
                @if (!$isFix)
                    @for ($i = 2; $i <= $maxParticipant; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                @else
                    <option value="{{ $maxParticipant }}">{{ $maxParticipant }}</option>
                @endif

            </x-select>
        </div>
    </div>
    @if (!$disbaledStatus)
        <div class="d-flex justify-content-center">
            <div class="btn btn-primary rounded-pill" wire:click="{{ $action }}" wire:loading.attr="disabled">{{ ucwords($action) }}</div>
        </div>
    @endif

</div>
