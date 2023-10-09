<div>
    <div>
        {{-- Because she competes with no one, no one can compete with her. --}}
        <section class="section">
            <div class="card">
                <div class="card-header d-flex flex-column ">
                    <div class="mt-3 d-md-inline-flex">
                        <div class="d-block mb-3">
                            <button type="button" wire:click="addManagePelatihan" class="btn btn-outline-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-plus-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                </svg>
                                <span>Tambah Pelatihan</span>
                            </button>
                        </div>
                        <div class="search row ms-auto me-3 mt-3 mt-sm-0">
                            <label for="staticEmail" class="d-none d-sm-flex col col-form-label">Cari</label>
                            <div class="col-12 col-sm-9">
                                <input type="text" class="form-control" id="inputPassword" wire:model="search"
                                    placeholder="Nama Pelatihan">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover rounded-md" id="table1">
                            <thead>
                                <tr class="table-secondary">
                                    <th>Fasilitasi</th>
                                    <th>Tanggal</th>
                                    <th>tahun</th>
                                    <th>Kategori</th>
                                 
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-hover">
                                @forelse ($data as $item)
                                    <tr>
                                      
                                        <td>{{ $item->name_pelatihan }}</td>
                                        <td>{{ $item->start_date. ' - ' .$item->end_date }}</td>
                                        <td>{{ $item->tahun }}</td>
                                       
                                        <td>{{ $item->categories->name_category  }}</td>
                                        
                                        <td>
                                            
                                            <span><a href="{{'/umkm/pelatihan/'.$item->slug_pelatihan }}"> <button type="button"
                                                 class="btn btn-outline-secondary m-1">PESERTA</button> </a> </span>

                                            <span><button type="button" class="btn btn-outline-secondary m-1"
                                                    id="editButton{{ encrypt($item->id) }}">EDIT</button></span>

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

        <x-modal name="{{ $formAction }}.Pelatihan" wire:model="{{ $formAction }}">
            <x-input name="nama" label="nama pelatihan" placeholder="Digital Marketing" />
            <x-select name="category" label="Category Pelatihan">
                @foreach ($categories as $item)
                    <option @selected(@$category == $item->id || old('category') == $item->id) value="{{ $item->id }}">
                        {{ $item->name_category }}
                    </option>
                @endforeach
            </x-select>
            <x-input name="start" type="date" label="Tanggal Pelatihan" />
            <x-input name="end" type="date" label="Tanggal Selesai Pelatihan" /> 
            <x-input name="tahun" type="number" label="tahun"  placeholder="2020"/> 
            <label for="describe"><strong> Deskripsi Pelatihan </strong></label> 
            <textarea class="form-control" id="describe" name="deskripsi" wire:model="deskripsi" ></textarea>
          
        </x-modal>
    </div>


</div>
