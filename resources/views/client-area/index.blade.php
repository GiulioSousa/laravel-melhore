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
        <div class="section-highlight__logo">
            <img src="{{ asset('img/logo-transp.png') }}" alt="" class="section-highlight__logo-img">
        </div>
        <section class="section" id="laudo">
            <h2 class="section-title">Dados do Cliente</h2>
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Métrica</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($metrics as $metric)
                        <tr>
                            <td>{{ date('d-m-Y', strtotime($metric->date)) }}</td>
                            <td>{{ $metric->metric_data }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h3 class="section-title">Diagnóstico</h3>
            @foreach ($diagnostics as $diagnostic)
                <p class="section-text">{{ $diagnostic->diagnostic_text }}</p>
            @endforeach
        </section>
        <section class="section" id="o-que-faremos">
            <h3 class="section-title">O que faremos</h3>
            @foreach ($videosWhatDo as $video)
                <article class="section-videos__item card">
                    <div class="list-videobox">
                        <iframe class="video video-list" width="560" height="315" src="https://www.youtube.com/embed/{{ $video->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <h4 class="section-videos__item-title">{{ $video->title }}</h4>
                    <p class="section-videos__item-description">{{ $video->description }}</p>
                </article>
            @endforeach
        </section>
        <section class="section" id="como-faremos">
            <h3 class="section-title">Como faremos</h3>
            @foreach ($videosHowDo as $video)
                <article class="section-videos__item card">
                    <div class="list-videobox">
                        <iframe class="video video-list" width="560" height="315" src="https://www.youtube.com/embed/{{ $video->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <h4 class="section-videos__item-title">{{ $video->title }}</h4>
                    <p class="section-videos__item-description">{{ $video->description }}</p>
                </article>
            @endforeach
        </section>
        <section class="section" id="equipe">
            <h3 class="section-title">Processos da equipe</h3>
            @foreach ($videosTeam as $video)
                <article class="section-videos__item card">
                    <div class="list-videobox">
                        <iframe class="video video-list" width="560" height="315" src="https://www.youtube.com/embed/{{ $video->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <h4 class="section-videos__item-title">{{ $video->title }}</h4>
                    <p class="section-videos__item-description">{{ $video->description }}</p>
                </article>
            @endforeach
        </section>
    </main>
    <x-footer />
</x-layout>