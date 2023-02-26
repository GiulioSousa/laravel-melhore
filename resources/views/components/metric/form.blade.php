<main class="main-container card-container">
    <section class="section card">
        <form class="form" action="{{ route($route, $arrayData) }}" method="post">
            @csrf
            @if ($route != 'metric.store')
                @method('PUT')
            @endif
            <h3 class="section-title"> {{ $title }} </h3>
            <div class="form__area">
                <div class="form__field">
                    <div class="form__input-box">
                        <input type="date" name="date" value="{{ $route == 'metric.store' ? "" : $metric->date }}" required>
                        <label for="date" class="form__label">Data</label>
                        <span class="form__line"></span>
                    </div>
                </div>
                <div class="form__field">
                    <div class="form__input-box">
                        <input type="number" name="metric_data" value="{{ $route == 'metric.store' ? '' : $metric->metric_data }}" required>
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