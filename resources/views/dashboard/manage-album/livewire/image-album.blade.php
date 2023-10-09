<div>
    {{-- <div class="btn btn-primary my-3">+ Tambah Dokumentasi</div> --}}
    <div class="border p-3 my-3">
        <div class="card p-2 my-5 border">
            <x-input name="image" type="file" label="Foto Album"  required="1" />
            <div wire:loading>
                Upload Image ...
            </div>
            <div class="btn btn-primary" wire:click="store" wire:target="image" wire:loading.attr="disabled">
                Upload
            </div>
        </div>

        <table class="table table-hover rounded-md" id="table1">
            <thead>
                <tr>
                    <td>Gambar</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($images as $item)
                <tr>
                    <td><img src="{{ asset($item->image_galery) }}" alt="{{ $item->id }}" height="100"></td>
                    <td><div wire:click="delete('{{ encrypt($item->id) }}')" class="btn btn-danger">Hapus</div></td>
                </tr>
                @empty
                <tr>
                    <td colspan="2">Data Tidak Ada</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
