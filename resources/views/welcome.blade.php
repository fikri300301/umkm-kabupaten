<x-guest-layout>
    <section class="top-section mt-3 mt-md-0">
        <div class="v181_3858"></div>
        <div class="container">
            <div class="home-main row align-items-center">
                <div class="col-12 col-md-6 col-lg-6 px-5 d-flex justify-content-center justify-content-md-end">
                    <div style="max-width: 450px;">
                        <div class="BEMFMIPAUNESA mb-3">
                            BEM FMIPA
                            UNESA
                        </div>
                        <div class="hr-main"></div>
                        <div class="description-main mt-3">
                            {!! $data[1]->value !!}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 px-5 d-flex justify-content-center mt-4 mt-md-0">
                    <img src="{{ asset($data[0]->value) }}" alt="Logo HOME PAGE" loading="lazy"/>
                </div>
            </div>
        </div>
    </section>

    <section class="program-kerja mb-4">
        <h2 class="text-center mb-3">Program Kerja Terdekat</h2>
        <livewire:partials.card-proker />
        <p class="text-center mb-3 mt-5">
            <a href="/proker" role="button" class="text-decoration-none">Jelajahi Proker -></a>
        </p>
    </section>
    <section class="new-artikel mb-4 mt-5 p-3">
        <h2 class="text-center mb-3">Artikel Terbaru</h2>
       <livewire:partials.card-artikel/>
        <p class="text-center mb-3 mt-5">
            <a href="/article" role="button" class="text-decoration-none">Jelajahi Artikel -></a>
        </p>
    </section>
    <section class="new-gallery mb-4 mt-5 p-3">
        <h2 class="text-center mb-3">Galeri Kegiatan</h2>
        {{-- <livewire:partials.card-gallery/> --}}
        <p class="text-center mb-3 mt-5">
            <a href="/galeri" role="button" class="text-decoration-none">Jelajahi Galeri -></a>
        </p>
    </section>
    <section class="reach-us mb-4 mt-5 p-3 contact" id="contact">
        <h2 class="text-center mb-3">Kontak Kami</h2>
        <div class="container mb-2 mt-5 pb-5">
           @livewire('contact')
        </div>
    </section>
</x-guest-layout>
