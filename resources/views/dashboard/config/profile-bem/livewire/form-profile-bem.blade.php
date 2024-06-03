<div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="my-3 border rounded p-3">
                    <x-textarea-tiny name="misi" label="misi" needLivewire="1"></x-textarea-tiny>
                    <div class="d-inline gap-3">
                        <button role="button" class="btn btn-primary ms-1" wire:click="updateMisi">Perbarui</button>
                    </div>
                </div>
                <div class="my-3 border rounded p-3">
                    <x-textarea-tiny name="visi" label="visi" needLivewire="1"></x-textarea-tiny>
                    <div class="d-inline gap-3">
                        <button role="button" class="btn btn-primary ms-1" wire:click="updateVisi">Perbarui</button>
                    </div>
                </div>

                <div class="my-3 border rounded p-3">
                    <x-input name="banner" label="banner *" type="file" />
                    <div class="d-inline gap-3">
                        <button role="button" class="btn btn-primary ms-1" wire:click="updateBanner">Perbarui</button>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-6 mb-2 text-center d-none" id="parent-review" wire:ignore>
                            <h6 class="mb-2">Review Sekarang</h6>
                            <img id="preview-image-before-upload" alt="preview image"
                                style="object-fit: cover; max-width:100%;">
                        </div>
                        @if (isset($banner_now))
                            <div class="col-12 col-md-6 mb-2 text-center" id="parent-banner-now">
                                <h6 class="mb-2">banner Sekarang</h6>
                                <img id="image-now" src="{{ asset($banner_now) }}" alt="preview image"
                                    style="object-fit: cover; max-width:100%;">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="my-3 border rounded p-3">
                    <x-input name="logo" label="logo *" type="file" />
                    <div class="d-inline gap-3">
                        <button role="button" class="btn btn-primary ms-1" wire:click="updateLogo">Perbarui</button>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-6 mb-2 text-center d-none" id="parent-review-logo" wire:ignore>
                            <h6 class="mb-2">Review Sekarang</h6>
                            <img id="preview-logo-before-upload" alt="preview logo"
                                style="object-fit: cover; max-width:100%;">
                        </div>
                        @if (isset($logo_now))
                            <div class="col-12 col-md-6 mb-2 text-center" id="parent-logo-now">
                                <h6 class="mb-2">logo Sekarang</h6>
                                <img id="logo-now" src="{{ asset($logo_now) }}" alt="preview logo"
                                    style="object-fit: cover; max-width:100%;">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="my-3 border rounded p-3">
                    <x-textarea-tiny name="descriptionLogo" label="Deskripsi Logo" needLivewire="1"></x-textarea-tiny>
                    <div class="d-inline gap-3">
                        <button role="button" class="btn btn-primary ms-1" wire:click="updateDesLogo">Perbarui</button>
                    </div>
                </div>
                <div class="my-3 border rounded p-3">
                    <x-textarea-tiny name="slogan" label="slogan" needLivewire="1"></x-textarea-tiny>
                    <div class="d-inline gap-3">
                        <button role="button" class="btn btn-primary ms-1" wire:click="updateSlogan">Perbarui</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script type="module">
            $('#banner').change(function(e) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#parent-review').removeClass('d-none');
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            $('#logo').change(function(e) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#parent-review-logo').removeClass('d-none');
                    $('#preview-logo-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        </script>
    @endpush

</div>
