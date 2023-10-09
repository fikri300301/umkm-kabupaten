<x-guest-layout>
    <section>
        <div class="v181_3858"></div>
        <div class="container p-3">
            <div class="row my-4">
                <div class="col-12 col-md-6 text-center">
                    <h2 class="mb-md-3 mb-2">{{ $division->name_division }}</h2>
                    <div class="mt-4">
                        {!! $division->description_division !!}
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-center">
                    <div class="card-divisi">
                        <img src="{{ asset("$division->thumbnail_division") }}" class="card-img-top"
                            alt="{{ $division->name_division }}" height="400" width="400">
                    </div>

                </div>
            </div>
            <div class="mt-5 mb-3 d-flex justify-content-center">
                <div class="thumbnail-anggota">
                    <img src="{{ asset("$division->thumbnail_anggota") }}" class="anggota-divisi"
                        alt="{{ $division->name_division }}">
                </div>
            </div>
            <div class="mt-4">
                {!! $division->description_anggota !!}
            </div>
        </div>

    </section>
    <section class="new-artikel mb-4 mt-5 p-3">
        <h2 class="text-center mb-3">Program Kerja Divisi</h2>
        <div class="container mb-2 mt-5">
            <div class="row align-items-stretch justify-content-center">
                <div class="col-12 col-lg-4">
                    @forelse ($division->proker as $divisi)
                        <div class="card mb-md-0 mb-4">
                            <img src="{{ asset("$divisi->thumbnail_proker") }}" class="card-img-top"
                                alt="thumbnail card" height="300">
                            <div class="card-body">
                                <h5 class="card-title">{{ $divisi->name_proker }}</h5>
                                <p class="text-muted">
                                    {{ $divisi->start_proker }} - {{ $divisi->end_proker }}
                                </p>
                                <p class="text-muted">
                                    <a href="#" class="text-reset">
                                        {{ $division->name_division }}
                                    </a>
                                </p>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ '/proker/' . $divisi->slug_proker }}"
                                        class="btn btn-primary rounded-pill">See More</a>
                                </div>
                            </div>
                        </div>
                </div>
                <p class="text-center mb-3 mt-5">
                    <a href="/proker" role="button" class="text-decoration-none">Jelajahi Proker -></a>
                </p>
            @empty
                <div class="alert alert-info text-center">
                    <h3>Belum Ada Proker</h3>
                </div>
                @endforelse
            </div>
    </section>
</x-guest-layout>
