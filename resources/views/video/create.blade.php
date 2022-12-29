<x-layout title="{{ $title }}" :style="$style">
    <x-header :user="$user" :home="$home" />
    <main class="main-container">
        <section class="section card">
            <form class="form" action="{{ route('video.store', ['user_id' => $user_id, 'tag' => $tag]) }}" method="post">
            @csrf
                <h3 class="section-title">Adicionar Video</h3>
                <div class="form__area">
                    <div class="form__field">
                        <div class="form__input-box">
                            <input type="text" name="title" value="" required>
                            <label for="title" class="form__label">Título do Vídeo</label>
                            <span class="form__line"></span>
                        </div>
                    </div>
                    <div class="form__field">
                        <div class="form__input-box">
                            <input type="text" name="description" value="" required>
                            <label for="description" class="form__label">Descrição</label>
                            <span class="form__line"></span>
                        </div>
                    </div>
                    <div class="form__field">
                        <div class="form__input-box">
                            <input type="text" name="url" value="" required>
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