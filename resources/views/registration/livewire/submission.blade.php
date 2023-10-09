<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    @php
        $disabled = false;
        if (!is_null($submission)) {
            $disabled = true;
        }
    @endphp
    <div class="w-100 border rounded-1 px-4 py-4 my-5">
        <h3 class="text-center">Pengumpulan Karya</h3>
        <div class="row mb-3">
            <div class="col-12">
                <x-input name="submission" label="Link Karya" disabled="{{ $disabled }}"  placeholder="https://drive.google.com/"/>
            </div>
        </div>
        @if (!$disabled)
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary rounded-pill" wire:click="store" wire:loading.attr="disabled">Kirim</button>
            </div>
        @endif

    </div>
</div>
