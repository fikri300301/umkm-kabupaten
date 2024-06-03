<div>
    {{-- Do your work, then step back. --}}
    @php
        $disbaledStatus = false;
        if ($status == 'pendaftaran berhasil') {
            $disbaledStatus = true;
        }
    @endphp
    <div class="anggota-tim mb-3 w-100 border rounded-1 p-4">
        <h5>Member {{ $index }} @if ($index == 1)
                / Ketua
            @endif
        </h5>
        <div class="row mb-3 mt-2">
            <div class="col-12 col-sm-6">
                <x-input name="name" label="Nama Anggota" disabled="{{ $disbaledStatus }}" />
            </div>
            <div class="col-12 col-sm-6">
                <x-input name="email" type="tel" label="Email Anggota" disabled="{{ $disbaledStatus }}" />
            </div>
            <div class="col-12">
                <x-input name="phone" label="Nomor Handphone" type="tel" disabled="{{ $disbaledStatus }}" />
            </div>
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

        <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary rounded-pill" wire:loading.attr="disabled"
                wire:click="{{ $action }}">{{ ucwords($action) }}</button>
        </div>
    </div>
</div>
