<x-layout title="{{ $title }}" :style="$style">
    <x-header :user="$user" :home="$home" />
    <main class="main-container">
        <section class="section card">
            <form class="form" action="{{ route('video.store') }}" method="post">
            @csrf
                <h3 class="section-title">Adicionar Video</h3>
                <div class="form__area">
                    <div class="form__field">
                        <div class="form__input-box">
                            <input type="text" name="video_title" value="" required>
                            <label for="video_title" class="form__label">Título do Vídeo</label>
                            <span class="form__line"></span>
                        </div>
                    </div>
                    <div class="form__field">
                        <div class="form__input-box">
                            <input type="text" name="video_description" value="" required>
                            <label for="video_description" class="form__label">Descrição</label>
                            <span class="form__line"></span>
                        </div>
                    </div>
                    <div class="form__field">
                        <div class="form__input-box">
                            <input type="text" name="video_url" value="" required>
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
</x-layout>