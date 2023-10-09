<x-guest-layout>
    <section class="mt-4">
        <div class="container">
            <h2 class="text-center fw-bold">{{ $album->name_album }}</h2>
            <div class="d-flex justify-content-center mt-5">
                <p class="text-center description-galery">
                    {!! $album->description_album !!}
                </p>
            </div>

            <div class="row mt-5">
                @foreach ($album->galleries as $item)
                    <div class="col-12 col-lg-6 mb-3">
                        <img src="{{ asset($item->image_galery) }}" class="rounded-3 img-fluid" alt="{{ $album->name_album }}" style="object-fit:contain;">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-guest-layout>
