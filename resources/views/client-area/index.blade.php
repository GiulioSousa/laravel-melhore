<x-layout title="{{ $title }}" :style="$style">
    <x-header :login="$login" :home="$home" />
    <main class="main-container">
        <h1 class="section-title">Bem vindo, {{ $login }}</h1>
        <section class="section">
            @foreach ($videosHighlight as $video)
                <h1 class="section-title">{{ $video->title }}</h1>
                <div class="section-videobox">
                    <iframe class="video card" width="560" height="315" src="https://www.youtube.com/embed/{{ $video->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <p class="section-text">{{ $video->description }}</p>
            @endforeach
        </section>
    </main>
    <x-footer />
</x-layout>