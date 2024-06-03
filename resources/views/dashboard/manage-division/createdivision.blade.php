<x-app-layout>
    <x-slot name="header">
        <h3>{{ ucWords($action) }} Division</h3>
        <p class="text-subtitle text-muted">This page for {{ $action }} division.</p>
    </x-slot>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <form class="my-2" id="form" enctype="multipart/form-data" method="post"
              action="/dashboard/{{ $action }}-division">
                @csrf 
                <input type="hidden" name="uniqId" value="{{ @$uniqId }}">
                <div class="mb-3">
                    <label for="status" class="form-label">
                        <h6>Status division</h6>
                    </label>
                    <div class="d-flex gap-2">
                        <div class="label-draft">
                            <p>Draft</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" value="publish"
                                @if (!isset($status)) @checked(true)
                            @elseif ($status == 'publish') @checked(true) @endif />
                        </div>
                        <div class="label-publish">
                            <p>Publish</p>
                        </div>
                    </div>
                </div>
                
                <x-select name="category_division" label="kategori division" value="{{ old('category_division') }}">
                    <option
                    @if (!is_null(old('category_division')))
                        @if (old('category_division') == 'harian')
                            selected
                        @endif
                    @elseif ($category_division == 'harian')
                        selected
                    @endif
                    value="harian">harian</option>

                <option
                    @if (!is_null(old('category_division')))
                        @if (old('category_division') == 'internal')
                            selected
                        @endif
                    @elseif ($category_division == 'internal')
                        selected
                    @endif
                    value="internal">internal</option>

                    <option
                    @if (!is_null(old('category_division')))
                        @if (old('category_division') == 'eksternal')
                            selected
                        @endif
                    @elseif ($category_division == 'eksternal')
                        selected
                    @endif
                    value="eksternal">eksternal</option>
                    
                  </x-select>

                    <x-input name="name_division" label="nama division" value="{{ $name ?? old('name_division') }}"
                        placeholder="internal" />
                
                    <x-textarea-tiny name="description_division" label="deskripsi divisi">
                        {{ @$description_division ?? old('description_division') }}</x-textarea-tiny>


                    <x-input name="thumbnail" label="Thumbnail division *" value="{{ @$thumbnail ?? old('thumbnail') }}"
                        type="file"  />

                    <div class="row mb-3">
                        <div class="col-12 col-md-6 mb-2 text-center d-none" id="parent-review">
                            <h6 class="mb-2">Review Sekarang</h6>
                            <img id="preview-image-before-upload" alt="preview image"
                                style="object-fit: cover; max-width:100%;">
                        </div>
                        @if (isset($thumbnail_now))
                            <div class="col-12 col-md-6 mb-2 text-center" id="parent-thumbnail-now">
                                <h6 class="mb-2">Thumbnail Sekarang</h6>
                                <img id="image-now" src="{{ asset($thumbnail_now) }}" alt="preview image"
                                    style="object-fit: cover; max-width:100%;">
                            </div>
                        @endif
                    </div>
                    <x-textarea-tiny name="description_anggota" label="deskripsi anggota">
                        {{ @$description_anggota ?? old('description_anggota') }}</x-textarea-tiny>
               
                   

                    <x-input name="thumbnail1" label="Thumbnail anggota division *" value="{{ @$thumbnail1 ?? old('thumbnail1') }}"
                    type="file"  />

                    <div class="row mb-3">
                        <div class="col-12 col-md-6 mb-2 text-center d-none" id="parent-review1">
                            <h6 class="mb-2">Review Sekarang</h6>
                            <img id="preview-image-before-upload1" alt="preview image"
                                style="object-fit: cover; max-width:100%;">
                        </div>
                        @if (isset($thumbnail_now1))
                            <div class="col-12 col-md-6 mb-2 text-center" id="parent-thumbnail-now">
                                <h6 class="mb-2">Thumbnail Sekarang</h6>
                                <img id="image-now" src="{{ asset($thumbnail_now1) }}" alt="preview image"
                                    style="object-fit: cover; max-width:100%;">
                            </div>
                        @endif
                    </div>


               <div class="d-inline gap-3">
                        <a href="{{ route('manage-division') }}" class="btn btn-warning">Cancel</a>
                        <button type="submit" class="btn btn-primary ms-1">Kirim</button>
              </div>

              </form>
            </div>
        </div>

       
    </section>

    @push('scripts')
    <script type="module">
    $('#thumbnail').change(function(e) {
        let reader = new FileReader();
        reader.onload = (e) => {
            console.log(e.target.result);
            $('#parent-review').removeClass('d-none');
            $('#preview-image-before-upload').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    $('#thumbnail1').change(function(e) {
       let reader = new FileReader();
       reader.onload = (e) => {
           console.log(e.target.result);
           $('#parent-review1').removeClass('d-none');
           $('#preview-image-before-upload1').attr('src', e.target.result);
       }
       reader.readAsDataURL(this.files[0]);
   });
</script>

@endpush




</x-app-layout>
