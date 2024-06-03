<x-guest-layout title="{{ $event->name_event }}" description="{{ Str::limit(strip_tags($event->description_event), 100, '...') }}">
    @php
        $startEvent = \Carbon\Carbon::parse($event->start_event);
        $endEvent = \Carbon\Carbon::parse($event->end_event);
        $now = \Carbon\Carbon::now();
    @endphp
    <section class="my-5 container text-wrap">
        <div class="v181_3858"></div>
        <div class="row">
            <div class="col-12 col-md-4 order-md-2">
                <div class="border border-2 p-3">
                    <h2 class="text-center">Pendaftaran</h2>
                    @guest
                        Silakan <a href="/login">Login</a>
                    @endguest
                    @auth
                        @if (!is_null($registered))
                            <div class="d-flex justify-content-center my-4">
                                <a href="/form/{{ $event->registration_event }}/{{ $event->slug_event }}"
                                    class="btn btn-info">Lihat Pendaftaran</a>
                            </div>
                        @else
                            @if ($event->quota <= $event->tim_count)
                                <div class="d-flex justify-content-center my-4">
                                    <a href="#" class="btn btn-danger"><i class="bi bi-sign-stop-fill"></i> Quota
                                        Penuh</a>
                                </div>
                            @else
                                <div class="d-flex justify-content-center my-4">
                                    <a href="/form/{{ $event->registration_event }}/{{ $event->slug_event }}"
                                        class="btn btn-primary"><i class="bi bi-pen-fill"></i> Daftar Sekarang</a>
                                </div>
                            @endif
                        @endif

                    @endauth
                </div>
                <div class="my-3 border border-2 p-3">
                    <h2 class="text-center">Detail Event</h2>
                    <ul class="list-unstyled mt-4 text-start">
                        <li class="mb-4 mt-4">
                            <h6><i class="bi bi-view-list"></i> Tipe Event</h6>
                            <div class="keterangan">{{ $event->type_event }}</div>
                        </li>
                        <li class="mb-4">
                            <h6><i class="bi bi-app-indicator"></i> Registrasi Event</h6>
                            <div class="keterangan">{{ $event->registration_event }}</div>
                        </li>
                        <li class="mb-4">
                            <h6><i class="bi bi-calendar-event"></i> Mulai Pendaftaran</h6>
                            <div class="keterangan">{{ $startEvent->format('d M Y H:i') }}</div>
                        </li>
                        <li class="mb-4">
                            <h6><i class="bi bi-calendar-check"></i> Selesai Pendaftaran</h6>
                            <div class="keterangan">{{ $endEvent->format('d M Y H:i') }}</div>
                        </li>
                        <li class="mb-4">
                            <h6><i class="bi bi-person-dash-fill"></i> Kuota Tersisa</h6>
                            <div class="keterangan">{{ $event->quota - $event->tim_count }} partisipan</div>
                        </li>
                        <li class="mb-4">
                            <h6><i class="bi bi-person-plus-fill"></i> Mengikuti</h6>
                            <div class="keterangan">{{ $event->tim_count }} partisipan</div>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col-12 col-md-8 order-md-1 border border-top-0 border-start-0 border-bottom-0 border-2">
                <h2>{{ $event->name_event }}</h2>
                <div class="my-3">
                    @if ($now->gt($endEvent))
                        <span class="badge ms-2 rounded-pill bg-danger">Pendaftaran Sudah Tutup</span>
                    @elseif ($now->between($startEvent, $endEvent))
                        <span class="badge ms-2 rounded-pill bg-info">Pendaftaran Sedang Berlangsung</span>
                    @else
                        <span class="badge ms-2 rounded-pill bg-warning">Pendaftaran Belum Di Buka</span>
                    @endif
                </div>
                <div class="article mt-3 mb-2">
                    <img src="{{ asset($event->thumbnail_event) }}" class="img-thumbnail"
                        alt="{{ $event->name_event }}" style="max-height: 600px;">
                    <div class="mt-4">
                        {!! $event->description_event !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
