<div>
    <section class="section">
        <div class="card">
            <div class="card-header d-flex flex-column ">
                <div class="mt-3 d-md-inline-flex">
                    <div class="d-block mb-3">
                        <button type="button" wire:click="addManageUmkm" class="btn btn-outline-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                            </svg>
                            <span>Tambah UMKM</span>
                        </button>
                    </div>

                     
                    <div class="search row ms-auto me-3 mt-3 mt-sm-0">
                        <label for="staticEmail" class="d-none d-sm-flex col col-form-label">Cari</label>
                        <div class="col-12 col-sm-9">
                            <input type="text" class="form-control" id="inputPassword" wire:model="search"
                                placeholder="Nama Perizinan">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <a href="/full-umkm"><button type="button" class="btn btn-primary mb-3">Full view</button></a>
                
                <div class="table-responsive">
                    <table class="table table-hover rounded-md" id="table1">
                        <thead>
                            <tr class="table-secondary">
                                <th>no</th>
                                <th>Nama UMKM</th>
                                <th>No hp</th>
                                <th>produk</th>
                                <th>pemilik</th>
                                <th>desa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->telepon }}</td>
                                    <td>{{ $item->produk }}</td>
                                    <td>{{ $item->pemilik }}</td>
                                    <td>{{ $item->desa->name_desa }}</td>
                                  
                                 
                                    <td>
                                        <span><button type="button" class="btn btn-outline-secondary m-1"
                                            wire:click="showUmkm('{{ $item->slug_umkm }}')"  ><i class="bi bi-eye"></i></span>

                                        <span><button type="button" class="btn btn-outline-secondary m-1"
                                                id="editButton{{ $item->slug_umkm }}">EDIT</span>

                                        <span>
                                            <button type="button" class="btn btn-outline-danger m-1"
                                                id="deleteButton{{ encrypt($item->id) }}">HAPUS</i></span>
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

    <x-modal name="Detail {{ $this->nama }}" kirim="0">
        <x-input name="nama" label="Nama UMKM" disabled='true' />
        <x-input name="produk" label="Produk" disabled='true'/>
        <x-input name="bidang" label="Bidang" disabled='true'/>
        <x-input name="telepon" label="No HP" disabled='true'/>
        <x-input name="nik" label="NIK" disabled='true'/>
        <x-input name="alamat" label="Alamat" disabled='true'/>
        <x-input name="rt" label="RT" disabled='true'/>
        <x-input name="rw" label="RW" disabled='true'/>
        <x-input name="desa" label="Desa" disabled='true'/>
        <x-input name="kecamatan" label="Kecamatan" disabled='true'/>
        <x-input name="kapasitas_produk" label="Kapasitas Produk" disabled='true'/>
        <x-input name="omset" label="Omset Per Tahun" disabled='true'/>
        <x-input name="tenaga_kerja" label="Tenaga Kerja" disabled='true'/>
        <x-input name="daerah_pemasaran" label="Daerah Pemasaran" disabled='true'/>
        <x-input name="modal_usaha" label="Modal Usaha" disabled='true'/>
        <x-input name="category" label="Kategori UMKM" disabled='true'/>
            <h6>Pelatihan Di ikuti</h6>
        <table class="table">
            <thead>
              <tr>
                <th>NO</th>
                <th>Nama Fasilitasi</th>
                <th>Tanggal</th>
                <th>Kategori</th>
              </tr>
            </thead>
            <tbody>
                @foreach ( $pelatihans as $pelatihan )
                <tr>
               
                {{-- @dd($pelatihan) --}}
                <td>{{ $loop->iteration }}</td>
                 <td> {{ $pelatihan->name_pelatihan }}</td> 
                 <td> {{ $pelatihan->start_date.' - '.$pelatihan->end_date }}</td> 
                 <td> {{ $pelatihan->categories->name_category }}</td> 
              
                @endforeach
              
                
              </tr>
            </tbody>
          </table>
        
          <h6>Bantuan di Terima</h6>
          <table class="table">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Nama Bantuan</th>
                  <th>Sumber</th>
                  <th>Tahun</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ( $bantuans as $bantuan )
                  <tr>
                 
                  {{-- @dd($pelatihan) --}}
                  <td>{{ $loop->iteration }}</td>
                   <td> {{ $bantuan->name_bantuan }}</td> 
                   <td> {{ $bantuan->sumber_bantuan }}</td> 
                   <td> {{ $bantuan->tahun }}</td> 
                
                  @endforeach
                
                  
                </tr>
              </tbody>
            </table>

            <h6>Perizinan di Terima</h6>
          <table class="table">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Nama Perizinan</th>
                  {{-- <th>No Perizinan</th> --}}
                </tr>
              </thead>
              <tbody>
                  @foreach ( $perizinans as $perizinan )
                  <tr>
                 
                  {{-- @dd($pelatihan) --}}
                  <td>{{ $loop->iteration }}</td>
                   <td> {{ $perizinan->name_perizinan }}</td> 
                   {{-- <td> {{ $perizinan->no_perizinan }}</td>  --}}
                    
                
                  @endforeach
                
                  
                </tr>
              </tbody>
            </table>

     
    </x-modal>
</div>
