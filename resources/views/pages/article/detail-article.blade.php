<x-guest-layout title="{{ $article->title_article }}" description="{{ Str::limit(strip_tags($article->body_article), 100, '...') }}">
    <section class="my-5 container text-wrap">
        <div class="v181_3858"></div>
        <h2>{{ $article->title_article }}</h2>
        <p class="my-3">Oleh <b>{{ $article->user->name }}</b> | {{ Carbon\Carbon::parse($article->created_at)->format('d M Y') }}</p>
        <a href="/article?categories={{ $article->categories->slug_category }}" class="btn category-article rounded-pill">{{ $article->categories->name_category }}</a>
        <div class="article mt-3 mb-2">
            <img src="{{ asset($article->image_article) }}" class="img-thumbnail" alt="{{ $article->title_article }}" style="max-height: 600px;">
            <div class="mt-4">
               {!! $article->body_article !!}
            </div>
        </div>
    </section>
</x-guest-layout>
