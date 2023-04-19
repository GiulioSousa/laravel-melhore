<main class="main-container card-container">
    <section class="section card">
        <form class="form" action="{{ route($route, $arrayData) }}" method="post">
        @csrf
        @if ($route != 'diagnostic.store')
            @method('PUT')
        @endif
        <h3 class="section-title">{{ $title }}</h3>
        <div class="form__area">
            <div class="form__field">
                <div class="form__input-box">
                    <input type="textarea" name="diagnostic_text" value="{{ old('diagnostic_text', $route == 'diagnostic.store' ? '' : $diagnostic->diagnostic_text) }}" required>
                    <label for="diagnostic_text" class="form__label">Diagnóstico</label>
                    <span class="form__line"></span>
                    @error('diagnostic_text')
                        <div class="form__alert">
                            {{ $message }}
                        </div>
                    @enderror
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