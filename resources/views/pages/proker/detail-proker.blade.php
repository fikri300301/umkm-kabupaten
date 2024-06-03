<x-guest-layout title="{{ $proker->name_proker }}" description="{{ Str::limit(strip_tags($proker->description_proker), 100, '...') }}">
    <section class="my-5 container text-wrap">
        <div class="v181_3858"></div>
        <h2>{{ $proker->name_proker }}</h2>
        <p class="my-3">Oleh <b>{{ $proker->user->name }}</b> | {{ Carbon\Carbon::parse($proker->created_at)->format('d M Y') }}</p>
        <a href="/proker?division={{ $proker->division->slug_proker }}" class="btn category-article rounded-pill">{{ $proker->division->name_division }}</a>
        <div class="article mt-3 mb-2">
            <img src="{{ asset($proker->thumbnail_proker) }}" class="img-thumbnail" alt="{{ $proker->name_proker }}" style="max-height: 600px;">
            <div class="mt-4">
               {!! $proker->description_proker !!}
            </div>
        </div>
    </section>
</x-guest-layout>
