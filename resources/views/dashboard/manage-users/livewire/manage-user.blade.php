<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <section class="section">
        <div class="card">
            <div class="card-header d-flex flex-column ">
                <div class="mt-3 d-md-inline-flex">
                    <div class="search row ms-auto me-3 mt-3 mt-sm-0">
                        <label for="staticEmail" class="d-none d-sm-flex col col-form-label">Cari</label>
                        <div class="col-12 col-sm-9">
                            <input type="text" class="form-control" id="inputPassword" wire:model="search"
                                placeholder="Nama">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover rounded-md" id="table1">
                        <thead>
                            <tr class="table-secondary">
                                <th>Nama</th>
                                <th>Email</th>
                                {{-- <th>Nomor HP</th> --}}
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    {{-- <td>{{ $item->phone }}</td> --}}
                                    <td>
                                        {{ $item->getRoleNames()->first() }}
                                    </td>
                                    <td>
                                        <span><button @disabled(Auth::id() == $item->id) type="button"
                                                class="btn btn-outline-secondary m-1"
                                                id="editButton{{ encrypt($item->id) }}">Edit</button></span>

                                        <span>
                                            <button @disabled(Auth::id() == $item->id) type="button"
                                                class="btn btn-outline-danger m-1"
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

    <x-modal name="{{ $formAction }}.User" wire:model="{{ $formAction }}">
        <x-input name="nama" label="Nama" placeholder="admin bem" disabled="true" />
        <x-input name="email" label="Email" type="email" placeholder="admin@bemfmipaunesa@gmail.com"
            disabled="true" />
        <x-input name="nomor_HP" label="Nomor Handphone" placeholder="089xxxxx" type="tel" disabled="true" />
        <x-select name="peran" label="Peran Pengguna">
            @foreach ($role as $item)
                <option value="{{ $item->name }}">{{ $item->name }}</option>
            @endforeach
        </x-select>
    </x-modal>
</div>
