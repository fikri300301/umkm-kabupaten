@if (session()->get('messageAction') == 'success')
    @push('scripts')
        <script type="module">
            const customEvent = new CustomEvent("messageSuccess", {
                detail: {
                    message: "Data berhasil Disimpan!"
                }
            });
            window.dispatchEvent(customEvent);
        </script>
    @endpush
@elseif (session()->get('messageAction') == 'error')
    @push('scripts')
    <script type="module">
        const customEvent = new CustomEvent("errorSuccess", {
            detail: {
                message: "Data Gagal Disimpan!"
            }
        });
        window.dispatchEvent(customEvent);
    </script>
    @endpush
@endif
