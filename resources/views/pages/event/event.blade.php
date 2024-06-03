<x-guest-layout>
    <div class="container">
        <div class="v181_3858"></div>
        <h2 class="text-center fw-bold mt-4">Event</h2>
        <div class="row">
            @forelse ($event as $item)
                <div class="col-12 col-md-4">
                    <div class="card">
                        <img src="{{ asset("$item->thumbnail_event") }}" class="card-img-top" alt="{{ $item->name_event }}"
                            height="300">
                        <div class="card-body">
                            <div>
                                <h5 class="d-inline card-title word-wrap">@excerpt($item->name_event, 10)</h5>
                                @php
                                    $startEvent = \Carbon\Carbon::parse($item->start_event);
                                    $endEvent = \Carbon\Carbon::parse($item->end_event);
                                    $now = \Carbon\Carbon::now();
                                @endphp

                                @if ($now->gt($endEvent))
                                    <span class="badge ms-2 rounded-pill bg-danger">Pendaftaran Sudah Tutup</span>
                                @elseif ($now->between($startEvent, $endEvent))
                                    <span class="badge ms-2 rounded-pill bg-info">Pendaftaran Sedang Berlangsung</span>
                                @else
                                    <span class="badge ms-2 rounded-pill bg-warning">Pendaftaran Belum Di Buka</span>
                                @endif

                            </div>

                            <p class=" mb-1 text-muted">
                                {{ $startEvent->format('d M Y') }} - {{ $endEvent->format('d M Y') }}
                            </p>
                            <p class="mt-0 text-muted fw-bolder">
                                {{ "$item->type_event | $item->registration_event" }}
                            </p>
                            <div class="d-flex justify-content-end">
                                <a href="/event/{{ $item->slug_event }}"
                                    class="btn btn-primary rounded-pill stretched-link">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center my-5">
                    <h2>Event Saat Ini Tidak Tersedia</h2>
                </div>
            @endforelse
        </div>
    </div>
</x-guest-layout>
