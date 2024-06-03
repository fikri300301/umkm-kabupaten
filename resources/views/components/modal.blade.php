@props(['name' => 'modal action', 'tutup' => 'true', 'kirim' => 'true'])
<div wire:ignore.self class="modal fade text-left" id="backdrop" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel4" data-bs-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel4">{{ ucwords(str_replace('.', ' ', $name)) }}</h4>
                <button type="button" class="close" aria-label="Close" wire:click="resetAll">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                @if ($tutup)
                    <button type="button" class="btn btn-light-secondary" wire:click="resetAll">
                        {{-- <i class="bx bx-x d-block d-sm-none"></i> --}}
                        <span class="">Tutup</span>
                    </button>
                @endif
                @if ($kirim)
                    <button type="button" class="btn btn-primary ms-1" wire:click="{{ str_replace('.', '', $name) }}">
                        {{-- <i class="bx bx-check d-block d-sm-none"></i> --}}
                        <span class="">Kirim</span>
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
