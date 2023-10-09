@props(['name', 'label', 'value', 'needLivewire' => '0'])
@push('style')
    <script src="{{ asset('/extension/tinymce/tinymce.min.js') }}"></script>
@endpush
<div class="mb-3" wire:ignore>
    <label for="{{ $name }}" class="form-label">
        <h6>{{ $label }}</h6>
    </label>
    <div class="w-80 d-flex justify-content-center" wire:ignore>
        <textarea @if ($needLivewire) wire:model="{{ $name }}" @endif name="{{ $name }}"
            id="{{ $name }}" class="form-control @error($name) is-invalid @enderror">{{ $slot }}</textarea>
    </div>
    @error($name)
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
            {{ $message }}
        </div>
    @enderror
</div>

@push('scripts')
    <script type="module">
        const useDarkMode = window.localStorage.theme === 'theme-dark';
        let tiny = null;

        async function initializeTinyMCE() {
            if (tiny !== null || tiny !== undefined) {
                tinymce.remove('textarea#{{ $name }}');
            }
            return new Promise((resolve) => {
                tinymce.init({
                    selector: 'textarea#{{ $name }}',
                    resize: 'both',
                    plugins: 'preview importcss searchreplace autolink autosave directionality code visualblocks visualchars fullscreen image link codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
                    menubar: 'file edit view insert format tools table help',
                    toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image link anchor codesample | ltr rtl',
                    autosave_ask_before_unload: true,
                    autosave_interval: '30s',
                    autosave_restore_when_empty: false,
                    autosave_retention: '2m',
                    image_advtab: true,
                    importcss_append: true,
                    file_picker_types: 'image',
                    automatic_uploads: true,
                    images_upload_url: '/image-upload',
                    convert_urls: false,
                    images_upload_handler: function(blobInfo, success, failure) {
                        var xhr, formData;
                        xhr = new XMLHttpRequest();
                        xhr.withCredentials = false;
                        xhr.open('POST', '/image-upload');
                        var token = '{{ csrf_token() }}';
                        xhr.setRequestHeader("X-CSRF-Token", token);
                        xhr.onload = function() {
                            var json;
                            if (xhr.status != 200) {
                                failure('HTTP Error: ' + xhr.status);
                                return;
                            }
                            json = JSON.parse(xhr.responseText);

                            if (!json || typeof json.location != 'string') {
                                failure('Invalid JSON: ' + xhr.responseText);
                                return;
                            }
                            success(json.location);
                        };
                        formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());
                        xhr.send(formData);
                    },
                    height: 700,
                    image_caption: true,
                    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                    toolbar_mode: 'sliding',
                    skin: useDarkMode ? 'oxide-dark' : 'oxide',
                    content_css: useDarkMode ? 'dark' : 'default',
                    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
                    setup: function(editor) {
                        @if ($needLivewire)
                            editor.on('change', function() {
                                console.log(editor.getContent());
                                @this.set('{{ $name }}', editor.getContent());
                            });
                        @endif
                    }
                });
            });
        }
        document.addEventListener('refresh-tinymce', async function() {
            tiny = await initializeTinyMCE();
        });

        initializeTinyMCE().then((editor) => {
            tiny = editor;
        });
    </script>
@endpush
