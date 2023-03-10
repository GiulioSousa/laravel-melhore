<x-layout title="{{ $title }}" :style="$style">
    <main class="container">
        <section class="card">
            <form action="{{ route('login.autenticar') }}" method="post" class="form">
                @csrf
                <h3 class="form__title">Área do Cliente</h3>
                <x-message />
                <div class="form__area">
                    <div class="form__field">
                        <div class="form__input-box">
                            <input type="text" name="login" required>
                            <label for="login" class="form__label">Login</label>
                            <span class="form__line"></span>
                        </div>
                    </div>
                    <div class="form__field">
                        <div class="form__input-box">
                            <input type="password" name="password" required>
                            <label for="password" class="form__label">Senha</label>
                            <span class="form__line"></span>
                        </div>
                    </div>
                </div>
                <div class="form__area">
                    <div class="form__field">
                        <input type="submit" value="Entrar" class="form__btn-submit">
                    </div>
                    <div class="form__field">                        
                        <button class="form__btn-submit">
                            <a href="/registrar">Registrar</a>
                        </button>
                    </div>
                </div>
            </form>
        </section>
        <div class="bg-img bg-img--logo"></div>
        <div class="bg-img bg-img--simbolo"></div>
    </main>
</x-layout>
