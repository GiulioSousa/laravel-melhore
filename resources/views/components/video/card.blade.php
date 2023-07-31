<section class="section">
    <h2 class="title section-title">{{ $title }}</h2>
    <ul class="section-list">
        @foreach ($videos as $video)
            <li class="section-videos__item card">
                <div class="list-videobox">
                    <iframe class="video video-list" width="560" height="315" src="https://www.youtube.com/embed/{{ $video->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <h4 class="section-videos__item-title">{{ $video->title }}</h4>
                <p class="section-videos__item-description">{{ $video->description }}</p>
                <div class="menu__edit-delete list-btn">
                    <a href="{{ route('video.edit', $video->id) }}" class="btn-delete--content card">Editar</a>
                    <form action="{{ route('video.destroy', $video->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="card btn-delete--content">Excluir</button>
                    </form>
                </div>
            </li>
        @endforeach
        <button class="item-btn-add">
            <a href="{{ route('video.create', ['id' => $id, 'tag' => $tag]) }}" class="btn-add-border">
                <span>Adicionar novo conteúdo</span>
            </a>
        </button>
    </ul>
</section>