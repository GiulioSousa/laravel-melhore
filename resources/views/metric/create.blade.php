<x-layout title="{{ $title }}" :style="$style">
    <x-header :user="$user" :home="$home" />
    <main class="main-container card-container">
        <section class="section card">
            <form class="form" action="{{ route('metric.store', ['user_id' => $user_id]) }}" method="post">
                @csrf
                <h3 class="section-title">Nova métrica / Editar métrica</h3>
                <div class="form__area">
                    <div class="form__field">
                        <div class="form__input-box">
                            <input type="date" name="date" value="" required>
                            <label for="date" class="form__label">Data</label>
                            <span class="form__line"></span>
                        </div>
                    </div>
                    <div class="form__field">
                        <div class="form__input-box">
                            <input type="number" name="metric_data" value="" required>
                            <label for="metric_data" class="form__label">Métrica</label>
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