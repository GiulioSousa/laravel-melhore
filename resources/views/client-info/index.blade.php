<x-layout title="Informações do cliente | Melhore" :style="$style" :user="$user" :home="$home">
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
                <a href="/novo-video">
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
                            <td>{{ $metric->date }}</td>
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
                <a href="/nova-metrica" class="btn-add-border">
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
                <a href="/novo-diagnostico" class="btn-add-border">
                    <span>Adicionar novo conteúdo</span>
                </a>
            </button>
        </section>
        <div class="division"></div>
        <section class="section">
            <h2 class="section-title">O que faremos:</h2>
            <ul class="section-list">
                @foreach ($videosWhatDo as $video)
                    <li class="section-videos__item card">
                        <div class="list-videobox">
                            <iframe class="video video-list" width="560" height="315" src="https://www.youtube.com/embed/{{ $video->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <h4 class="section-videos__item-title">{{ $video->title }}</h4>
                        <p class="section-videos__item-description">{{ $video->description }}</p>
                        <div class="menu__edit-delete list-btn">
                            <a href="/editar-video" class="btn-delete--content card">Editar</a>
                            <a href="/excluir-video" class="btn-delete--content card">Excluir</a>
                        </div>
                    </li>
                @endforeach
                <button class="item-btn-add">
                    <a href="/novo-video" class="btn-add-border">
                        <span>Adicionar novo conteúdo</span>
                    </a>
                </button>
            </ul>
        </section>
        <div class="division"></div>
        <section class="section">
            <h2 class="section-title">Como faremos:</h2>
            <ul class="section-list">
                @foreach ($videosHowDo as $video)
                    <li class="section-videos__item card">
                        <div class="list-videobox">
                            <iframe class="video video-list" width="560" height="315" src="https://www.youtube.com/embed/{{ $video->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <h4 class="section-videos__item-title">{{ $video->title }}</h4>
                        <p class="section-videos__item-description">{{ $video->description }}</p>
                        <div class="menu__edit-delete list-btn">
                            <a href="/editar-video" class="btn-delete--content card">Editar</a>
                            <a href="/excluir-video" class="btn-delete--content card">Excluir</a>
                        </div>
                    </li>
                @endforeach
                <button class="item-btn-add">
                    <a href="/novo-video" class="btn-add-border">
                        <span>Adicionar novo conteúdo</span>
                    </a>
                </button>
            </ul>
        </section>
        <div class="division"></div>
        <section class="section">
            <h2 class="section-title">Processos da equipe:</h2>
            <ul class="section-list">
                @foreach ($videosTeam as $video)
                    <li class="section-videos__item card">
                        <div class="list-videobox">
                            <iframe class="video video-list" width="560" height="315" src="https://www.youtube.com/embed/{{ $video->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <h4 class="section-videos__item-title">{{ $video->title }}</h4>
                        <p class="section-videos__item-description">{{ $video->description }}</p>
                        <div class="menu__edit-delete list-btn">
                            <a href="/editar-video" class="btn-delete--content card">Editar</a>
                            <a href="/excluir-video" class="btn-delete--content card">Excluir</a>
                        </div>
                    </li>
                @endforeach
                <button class="item-btn-add">
                    <a href="/novo-video" class="btn-add-border">
                        <span>Adicionar novo conteúdo</span>
                    </a>
                </button>
            </ul>
        </section>
    <x-footer />
    </main> 
</x-layout>