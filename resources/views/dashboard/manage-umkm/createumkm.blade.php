<x-app-layout>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <x-slot name="header">
        <h3>{{ ucWords($action) }} UMKM</h3>
        <p class="text-subtitle text-muted">Halaman ini untuk {{ $action }} proker.</p>
    </x-slot>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <form class="my-2" id="form" enctype="multipart/form-data" method="post"
                    action="/dashboard/store-umkm">
                    @csrf
                    <input type="hidden" name="uniqId" value="{{ @$uniqId }}">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Field form lainnya -->

                    <x-input name="nama" label="Nama " value="{{ $nama ?? old('nama') }}" placeholder="Nama UMKM"
                        required="1" />

                    <x-select name="bidang_id" label="Bidang">
                        @foreach ($bidang as $item)
                            <option @selected(@$bidang_id == $item->id || old('bidang_id') == $item->id) value="{{ $item->id }}">
                                {{ $item->name_bidang }}
                            </option>
                        @endforeach
                    </x-select>

                    <x-input name="produk" label="Produk " value="{{ $produk ?? old('produk') }}" placeholder="Mie"
                        required="1" />

                    <x-input name="pemilik" label="Nama Pemilik" value="{{ $pemilik ?? old('pemilik') }}"
                        placeholder="Nama Pemilik" required="1" />

                    <x-input name="telepon" label="NO HP" value="{{ $telepon ?? old('telepon') }}"
                        placeholder="085XXXXXXXXX" required="1" />

                    <x-input class="form-control" name="nik" label="NIK" value="{{ $nik ?? old('nik') }}"
                        placeholder="085XXXXXXXXX" required="1" />

                    <x-input name="alamat" label="Alamat" value="{{ $alamat ?? old('alamat') }}"
                        placeholder="Nama jalan dan no rumah" required="1" />

                    <x-input name="rt" label="RT" value="{{ $rt ?? old('rt') }}" placeholder="08"
                        required="1" />

                    <x-input name="rw" label="RW" value="{{ $rw ?? old('rw') }}" placeholder="08"
                        required="1" />

                    <x-select name="desa_id" label="Desa">
                        @foreach ($desa as $item)
                            <option @selected(@$desa_id == $item->id || old('desa_id') == $item->id) kecamantanId="{{ $item->kecamatan_id }}"
                                value="{{ $item->id }}">
                                {{ $item->name_desa }}
                            </option>
                        @endforeach
                    </x-select>

                    <x-select name="kecamatan_select" label="Kecamatan" disabled='true'>
                        @foreach ($kecamatan as $item)
                            <option @selected(@$kecamatan_id == $item->id || old('kecamatan_id') == $item->id) value="{{ $item->id }}">
                                {{ $item->name_kecamatan }}
                            </option>
                        @endforeach
                    </x-select>
                    <input type="hidden" name="kecamatan_id" id="kecamatan_id" value="{{ $kecamatan_id }}">
                    <x-input type="number" name="kapasitas_produk" label="Kapasitas Produk"
                        value="{{ $kapasitas_produk ?? old('kapasitas_produk') }}" required="1" />

                    <x-input type="number" name="omset" label="Omset Pertahun" value="{{ $omset ?? old('omset') }}"
                        required="1" />

                    <x-input type="number" name="tenaga_kerja" label="Tenaga Kerja"
                        value="{{ $tenaga_kerja ?? old('tenaga_kerja') }}" required="1" />

                    <x-input name="daerah_pemasaran" label="Daerah Pemasaran"
                        value="{{ $daerah_pemasaran ?? old('daerah_pemasaran') }}" placeholder="Daerah Pemasaran"
                        required="1" />

                    <x-input name="modal_usaha" type="number" label="Modal Usaha"
                        value="{{ $modal_usaha ?? old('modal_usaha') }}" placeholder="50.000.000" required="1" />

                    <x-select name="categories_id" label="Kategori UMKM" id="categories_id">
                        @foreach ($categories as $item)
                            <option @selected(@$categories_id == $item->id || old('categories_id') == $item->id) value="{{ $item->id }}">
                                {{ $item->name_category . ' || ' . $item->angka }}
                            </option>
                        @endforeach
                    </x-select>

                    <div class="d-inline gap-3">
                        <a href="{{ route('dashboard') }}" class="btn btn-warning">Cancel</a>
                        <button type="submit" class="btn btn-primary ms-1">Kirim</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @push('scripts')
        <script type="module">
            $(document).ready(function() {
                $('.select-multiple').select2();
                $('#desa_id').change((e) => {
                    var attributes = $(e.target).find('option:selected').prop("attributes");
                    // console.log(attributes[0].value);
                    $('#kecamatan_id').val(attributes[0].value);
                    $('#kecamatan_select').val(attributes[0].value);
                });
            });
        </script>
    @endpush

</x-app-layout>

{{-- <div class="mb-3">
                    <label for="bantuan" class="form-label">
                        <h6>Bantuan</h6>
                    </label>
                    <div>
                        <div class="form-group">
                            <select class="form-control select-multiple" name="bantuan[]" multiple 
                                style="width: 100%;">
                                @foreach ($bantuan as $item)
                                    <option value="{{ $item->id }}" id="{{ $item->name_bantuan }}">
                                        {{ $item->name_bantuan }} | {{ $item->tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('bantuan')
                        <div class="alert alert-light-danger alert-dismissible fade show color-danger my-2">
                            <i class="bi bi-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div> --}}

{{-- <div class="mb-3">
                    <label for="Pelatihan" class="form-label">
                        <h6>Pelatihan</h6>
                    </label>
                    <div>
                        <div class="form-group">
                            <select class="form-control select-multiple" name="pelatihan[]" multiple 
                                style="width: 100%;" wire:model="pelatihan">
                                @foreach ($pelatihan as $item)
                                    <option value="{{ $item->id }}" id="{{ $item->name_pelatihan }}">
                                        {{ $item->name_pelatihan }} | {{ $item->tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('pelatihan')
                        <div class="alert alert-light-danger alert-dismissible fade show color-danger my-2">
                            <i class="bi bi-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror --}}
