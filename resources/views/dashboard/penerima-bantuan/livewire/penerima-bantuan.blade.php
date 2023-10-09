<div>
    <div wire:init="ons">
        {{-- Because she competes with no one, no one can compete with her. --}}
        <h3> {{ $this->nama }}</h3>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex flex-column ">
                    
                    <div class="mt-3 d-md-inline-flex">
                        <div class="d-block mb-3">
                            <button type="button" wire:click="addPenerimaBantuan" class="btn btn-outline-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-plus-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                </svg>
                                <span>Tambah penerima bantuan</span>
                            </button>
                        </div>
                    
                        <div class="search row ms-auto me-3 mt-3 mt-sm-0">
                            <label for="staticEmail" class="d-none d-sm-flex col col-form-label">Cari</label>
                            <div class="col-12 col-sm-9">
                                <input type="text" class="form-control" id="inputPassword" wire:model="search"
                                    placeholder="Nama UMKM">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover rounded-md" id="table1">
                            <thead>
                                <tr class="table-secondary">
                                    <th>no
                                    <th>Nama pemilik</th>
                                    <th>Nama umkm</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-hover">
                                @forelse ($data as $item)
                                    <tr>
                                      
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $item->pemilik }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>

                                            {{-- <span><button type="button" class="btn btn-outline-primary m-1"
                                                id="editButton{{ encrypt($item->id) }}">Desa</button></span> --}}


                                            <span>
                                                <button type="button" class="btn btn-outline-danger m-1"
                                                    id="deleteButton{{ encrypt($item['id']) }}">Hapus</button></span>
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
                            {{-- {{ $data->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>

         <x-modal name="{{ $formAction }}.PenerimaBantuan" wire:model="{{ $formAction }}">
       
            <x-select name="umkm_id" label="Category Pelatihan">
                @foreach ($umkms as $item)
                    <option @selected(@$umkm == $item->id || old('umkm_id') == $item->id) value="{{ $item->id }}">
                        {{ $item->nama }} || {{  $item->pemilik}}
                    </option>
                @endforeach
            </x-select>
            
        </x-modal> 
    </div>


</div>

