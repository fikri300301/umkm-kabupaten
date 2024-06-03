<div class="table-responsive">
    <table class="table table-hover rounded-md" id="table1">
        <thead>
            <tr class="table-secondary">
                <th>no</th>
                <th>Nama UMKM</th>
                <th>Bidang</th>
                <th>Produk</th>
                <th>Pemilik</th>
                <th>Telepon</th>
                <th>NIK</th>
                <th>Alamat</th>
                <th>RT</th>
                <th>RW</th>
                <th>Kecamatan</th>
                <th>Desa</th>
                <th>Kapasitas Produk</th>
                <th>Omset</th>
                <th>Tenaga Kerja</th>
                <th>Modal Usaha</th>
                <th>Daerah pemasaran</th>
                <th>Kategori umkm</th>
              
            </tr>
        </thead>
        <tbody class="table-hover">
            @forelse ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->bidang->name_bidang }}</td>
                    <td>{{ $item->produk }}</td>
                    <td>{{ $item->pemilik }}</td>
                    <td>{{ $item->telepon }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->rt }}</td>
                    <td>{{ $item->rw }}</td>
                    <td>{{ $item->desa->name_desa }}</td>
                    <td>{{ $item->kecamatan->name_kecamatan }}</td>
                    <td>{{ $item->kapasitas_produk }}</td>
                    <td>{{ $item->omset }}</td>
                    <td>{{ $item->tenaga_kerja }}</td>
                    <td>{{ $item->modal_usaha }}</td>
                    <td>{{ $item->daerah_pemasaran }}</td>
                    
                    <td>{{ $item->category->name_category }}</td>
                 
                   
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