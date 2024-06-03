<div>
    <div>
        {{-- Because she competes with no one, no one can compete with her. --}}
        <section class="section">
            <div class="card">
                <div class="card-header d-flex flex-column ">
                    <div class="mt-3 d-md-inline-flex">
                        <div class="d-block mb-3">
                            <span>
                                total pesan :{{ count($data) }}</span>
                        </div>
                        <div class="search row ms-auto me-3 mt-3 mt-sm-0">

                            <label for="staticEmail" class="d-none d-sm-flex col col-form-label">Cari</label>
                            <div class="col-12 col-sm-9">
                                <input type="text" class="form-control" id="inputPassword" wire:model="search"
                                    placeholder="Nama Pengirim">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover rounded-md" id="table1">
                            <thead>
                                <tr class="table-secondary">
                                    <th>Nama pengirim</th>
                                    <th>Email pengirim </th>
                                    <th>Topik</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-hover">
                                @forelse ($data as $item)
                                    <tr>
                                        <td>{{ $item->name_contact }}</td>
                                        <td>{{ $item->email_contact }}</td>
                                        <td>{{ $item->subject_contact }}</td>
                                        <td>
                                            <span><button type="button" class="btn btn-outline-secondary m-1"
                                                    id="editButton{{ encrypt($item->id) }}">detail</button></span>

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
        <x-modal name="{{ $formAction }}.contact" wire:model="{{ $formAction }}" kirim="0">
            <x-input name="name" label="nama kategori" disabled="1" />
            <x-input name="email" label="nama email" disabled="1" />
            <x-input name=subject label="subject" disabled="1"/>
            <x-input name="body" label="detail" disabled="1" />
        </x-modal>
    </div>


</div>


