<x-layout title="Informações do cliente | Melhore" :style="$style">
    <x-header :login="$user->login" :home="$home" :avatar="$user->avatar" />
        <main class="main-container">
        <x-message />
        <h1 class="title page-title">Conteúdo - {{ $clientName }}</h1>
        <section class="section">
            @foreach ($videosHighlight as $video)
                <h2 class=" title section-title">{{ $video->title }}</h2>
                <div class="section-videobox">
                    <iframe class="video card" width="560" height="315" src="https://www.youtube.com/embed/{{ $video->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <p class="section-text">{{ $video->description }}</p>
                <div class="menu__edit-delete">
                    <a href="{{ route('video.edit', $video->id) }}" class="card btn-delete--content">Editar</a>
                    <form action="{{ route('video.destroy', $video->id) }}" method="post" class="card btn-delete--content">
                        @csrf
                        @method('DELETE')
                        <button class="">Excluir</button>
                    </form>
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
            <h2 class="title section-title">Métricas</h2>
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
                                    <button class="metric-menu__btn">...</button>
                                    <button class="card metric-menu__btn-close">Fechar</button>
                                    <a href="{{ route('metric.edit', $metric->id) }}" class="btn-delete--content card metric-menu__edit">Editar</a>
                                    <form action="{{ route('metric.destroy', $metric->id) }}" method="post" class="metric-menu__form">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-delete--content card metric-menu__delete">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
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
            <h2 class="title section-title">Diagnóstico</h2>
            @foreach ($diagnostics as $diagnostic)
            <p class="section-text"> {{ $diagnostic->diagnostic_text }}</p>
            <div class="menu__edit-delete">
                <a href="{{ route('diagnostic.edit', $diagnostic->id) }}" class="btn-delete--content card">Editar</a>
                <form action="{{ route('diagnostic.destroy', $diagnostic->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn-delete--content card">Excluir</button>
                </form>
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

        <form method="post" action="{{ route('account.destroy', $clientId) }}" class="form-delete">
            @csrf
            @method('DELETE')
            <button class="card btn-delete">Excluir perfil</button>
        </form>
        
    <x-footer />
    </main> 
</x-layout>