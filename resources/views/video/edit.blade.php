<x-layout title="{{ $title }}" :style="$style">
    <x-header :user="$user" :home="$home" />
    <main class="main-container">
        <section class="section card">
            <form class="form" action="{{ route('video.update', ['id' => $video['id']]) }}" method="post">
            @csrf
            @method('PUT')
                <h3 class="section-title">Editar Video</h3>
                <div class="form__area">
                    <div class="form__field">
                        <div class="form__input-box">
                            <input type="text" name="title" value="{{ $video['title'] }}" required>
                            <label for="title" class="form__label">Título do Vídeo</label>
                            <span class="form__line"></span>
                        </div>
                    </div>
                    <div class="form__field">
                        <div class="form__input-box">
                            <input type="text" name="description" value="{{ $video['description'] }}" required>
                            <label for="description" class="form__label">Descrição</label>
                            <span class="form__line"></span>
                        </div>
                    </div>
                    <div class="form__field">
                        <div class="form__input-box">
                            <input type="text" name="url" value="{{ $video['url'] }}" required>
                            <label for="url" class="form__label">URL do video</label>
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
</x-layout>