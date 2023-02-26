<main class="main-container">
    <section class="section card">
        <form class="form" action="{{ route($route, $arrayData) }}" method="post">
            @csrf
            @if ($route != 'video.store')
                @method('PUT')
            @endif
            <h3 class="section-title">{{ $title }}</h3>
            <div class="form__area">
                <div class="form__field">
                    <div class="form__input-box">
                        <input type="text" name="video_title" value="{{ $route == 'video.store' ? "" : $video['title'] }}" required>
                        <label for="video_title" class="form__label">Título do Vídeo</label>
                        <span class="form__line"></span>
                    </div>
                </div>
                <div class="form__field">
                    <div class="form__input-box">
                        <input type="text" name="video_description" value="{{ $route == 'video.store' ? "" : $video['description'] }}" required>
                        <label for="video_description" class="form__label">Descrição</label>
                        <span class="form__line"></span>
                    </div>
                </div>
                <div class="form__field">
                    <div class="form__input-box">
                        <input type="text" name="video_url" value="{{ $route == 'video.store' ? "" : $video['url'] }}" required>
                        <label for="video_url" class="form__label">URL do video</label>
                        <span class="form__line"></span>
                    </div>
                </div>
            </div>
            <div class="form__area">
                <div class="form__field">
                    <input type="submit" value="Salvar" class="form__btn-submit">
                </div>
            </div>
        </form>
    </section>
</main>