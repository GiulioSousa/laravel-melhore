<x-layout title="Informações do cliente | Melhore" :style="$style">
    <x-header :user="$user" :home="$home" />
        <main class="main-container">
        <h1 class="section-title">Conteúdo - {{ $clientName }}</h1>
        <section class="section">
            @foreach ($videosHighlight as $video)
                <h2 class="section-title">{{ $video->title }}</h2>
                <div class="section-videobox">
                    <iframe class="video card" width="560" height="315" src="https://www.youtube.com/embed/{{ $video->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <p class="section-text">{{ $video->description }}</p>
                <div class="menu__edit-delete">
                    <a href="/editar-video" class=" card btn-delete--content">Editar</a>
                    <a href="/excluir-video" class="card btn-delete--content">Excluir</a>
                </div>
            @endforeach 
            <button class="item-btn-add">
                <a href="{{ route('video.create', ['id' => $id, 'tag' => 'highlight']) }}">
                    <span>Adicionar novo conteúdo</span>
                </a>
            </button>
        </section>
        <div class="division"></div>
        <section class="section">
            <h2 class="section-title">Métricas</h2>
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
                            <td>
                                <div class="metric-menu">
                                    <span class="metric-menu__btn">...</span>
                                    <span class="card metric-menu__btn-close">Fechar</span>
                                    <a href="/editar-metrica" class="btn-delete--content card metric-menu__edit">Editar</a>
                                    <a href="/excluir-metrica" class="btn-delete--content card metric-menu__delete">Excluir</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button class="item-btn-add">
                <a href="{{ route('metric.create', ['id' => $id]) }}" class="btn-add-border">
                    <span>Adicionar novo conteúdo</span>
                </a>
            </button>
        </section>
        <div class="division"></div>
        <section class="section">
            <h2 class="section-title">Diagnóstico</h2>
            @foreach ($diagnostics as $diagnostic)
                <p class="section-text"> {{ $diagnostic->diagnostic_text }}</p>
                <div class="menu__edit-delete">
                    <a href="/editar-diagnostico" class="btn-delete--content card">Editar</a>
                    <a href="/excluir-diagnostico" class="btn-delete--content card">Excluir</a>
                </div>
            @endforeach
            <button class="item-btn-add">
                <a href="{{ route('diagnostic.create', ['id' => $id]) }}" class="btn-add-border">
                    <span>Adicionar novo conteúdo</span>
                </a>
            </button>
        </section>
        <div class="division"></div>

        <x-video.card :title="'O que faremos'" :videos="$videosWhatDo" :id="$id" :tag="'whatDo'" />

        <div class="division"></div>
        
        <x-video.card :title="'Como faremos'" :videos="$videosHowDo" :id="$id" :tag="'howDo'" />
        
        <div class="division"></div>

        <x-video.card :title="'Processos da equipe'" :videos="$videosTeam" :id="$id" :tag="'team'" />

    <x-footer />
    </main> 
</x-layout>