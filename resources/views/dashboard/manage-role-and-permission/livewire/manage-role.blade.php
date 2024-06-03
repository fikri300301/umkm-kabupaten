<div>
    {{-- Do your work, then step back. --}}
    <section class="section">
        <div class="card">
            <div class="card-header d-flex flex-column ">
                <div class="mt-3 d-md-inline-flex">
                    <div class="d-block mb-3">
                        <button type="button" wire:click="addRole" class="btn btn-outline-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                            </svg>
                            <span>Tambah Peran</span>
                        </button>
                    </div>
                    <div class="search row ms-auto me-3 mt-3 mt-sm-0">
                        <label for="staticEmail" class="d-none d-sm-flex col col-form-label">Cari</label>
                        <div class="col-12 col-sm-9">
                            <input type="text" class="form-control" id="inputPassword" wire:model="search"
                                placeholder="Nama Peran">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover rounded-md" id="table1">
                        <thead>
                            <tr class="table-secondary">
                                <th>Nama Peran</th>
                                <th>Deskripsi Peran</th>
                                <th>Total Permission</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->permissions->count() }}</td>
                                    <td>
                                        <span><button type="button" class="btn btn-outline-secondary m-1"
                                                id="editButton{{ encrypt($item->id) }}">Edit</button></span>

                                        <span>
                                            <button type="button" class="btn btn-outline-danger m-1"
                                                id="deleteButton{{ encrypt($item->id) }}">Hapus</button></span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <h4>Data Tidak Di Temukan</h4>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modal name="{{ $formAction }}.Role" wire:model="{{ $formAction }}">
        <x-input name="nama" label="nama" placeholder="super-admin" />
        <x-input name="deskripsi" label="deskripsi" placeholder="ini super admin" />
        <div class="mb-3">
            <label for="hak_akses_peran" class="form-label">
                <h6>Hak Akses Untuk Peran</h6>
            </label>
            <div>
                <div class="form-group">
                    <select class="selectedSelect" name="permissions_role[]" multiple="multiple" id="selectedSelect"
                        style="width: 100%;" wire:model="permissions_role">
                        @foreach ($permission as $item)
                            <option value="{{ $item->name }}" id="{{ $item->name }}">
                                {{ $item->name }} | {{ $item->description }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('permissions_role')
                <div class="alert alert-light-danger alert-dismissible fade show color-danger my-2">
                    <i class="bi bi-exclamation-circle"></i>
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>
    </x-modal>

    @push('scripts')
        <script type="module">
                window.livewire.on('select2', (event) => {
                    $('#selectedSelect').select2({
                        allowClear: true,
                    }).on('change', function(e) {
                        e.preventDefault();
                        let data = $('#selectedSelect').val();
                        @this.set('permissions_role', data);
                    });
                });
        </script>
    @endpush
</div>
