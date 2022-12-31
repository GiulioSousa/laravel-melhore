<x-layout title="{{ $title }}" :style="$style">
    <x-header :user="$user" :home="$home" />
    <main class="main-container card-container">
        <section class="section card">
            <form class="form" action="{{ route('diagnostic.store', ['user_id' => $user_id]) }}" method="post">
            @csrf
            <h3 class="section-title">Editar diagnóstico/Novo Diagnóstico</h3>
            <div class="form__area">
                <div class="form__field">
                    <div class="form__input-box">
                        <input type="textarea" name="diagnostic_text" value="" required>
                        <label for="diagnostic_text" class="form__label">Diagnóstico</label>
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
    <x-footer />
</x-layout>