<div>
    @php
        $disbaledStatus = false;
        if ($status == 'pendaftaran berhasil') {
            $disbaledStatus = true;
        }
    @endphp
    <h3 class="text-center">Informasi Pendaftar</h3>
    <div class="row mb-3">
        <div class="col-12 col-sm-6">
            <x-input name="name" label="Nama" disabled="{{ $disbaledStatus }}" />
        </div>
        <div class="col-12 col-sm-6">
            <x-input name="email" type="email" label="Email" disabled="{{ $disbaledStatus }}" />
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 col-sm-6">
            <x-input name="instansi" label="Instansi" disabled="{{ $disbaledStatus }}" />
        </div>
        <div class="col-12 col-sm-6">
            <x-input name="phone" type="tel" label="Phone" disabled="{{ $disbaledStatus }}" />
        </div>
    </div>

    <div class="row mb-3">
        <h5>Persyaratan : </h5>
        @foreach ($required as $item)
                @php
                    $label = $item->label;
                    if ($item->required) {
                        $label .= ' *';
                    } else {
                        $label .= ' (optional)';
                    }
                @endphp
                <div class="col-12">
                    <x-input name="value.{{ $item->id }}" label="{{ $label }}" type="{{ $item->type }}"
                        required="{{ $item->required }}" disabled="{{ $disbaledStatus }}"/>
                    @if ($item->type == 'file')
                        <div wire:loading wire:target="value.{{ $item->id }}">
                            Loading Upload.....
                        </div>
                        @isset($value[$item->id])
                            @if (strpos($value[$item->id], 'tmp') === false)
                                <div id="value.{{ $item->id }}" class="form-text"><a
                                        href="{{ asset($value[$item->id]) }}" target="_blank">Klik
                                        Disini Untuk Review</a></div>
                            @endif
                        @endisset
                    @endif
                </div>
            @endforeach
    </div>


    @if (!$disbaledStatus)
        <div class="d-flex justify-content-center">
            <div class="btn btn-primary rounded-pill" wire:click="{{ $action }}" wire:loading.attr="disabled">{{ ucwords($action) }}</div>
        </div>
    @endif

</div>
