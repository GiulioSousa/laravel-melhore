<x-layout title="{{ $title }}" :style="$style">
    <x-header :login="$user->login" :home="$home" :avatar="$user->avatar" />
    <main class="main-container card-container">
        <section class="section card">
            <form 
                class="form" 
                action="{{ route('account.update') }}" method="post" 
                enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <h3 class="form__title">Editar conta</h3>
            <div class="form__area">
                <div class="form__field form__img">
                    <div class="input__img">
                        <input 
                            type="file" 
                            name="avatar" 
                            id="avatar">
                        <label 
                            for="avatar" class="account__profile-link">
                            Alterar imagem
                        </label>
                        <img 
                            src="{{ asset('storage/' . $user->avatar) }}" 
                            alt="" 
                            class="account__profile">
                    </div>
                    @error('avatar')
                        <div class="form__alert form__alert--img">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form__field">
                    <div class="form__input-box">
                        <input 
                            type="text" 
                            name="login" 
                            value="{{ $user->login }}" required>
                        <label for="login" class="form__label">
                            Nome de usuário
                        </label>
                        <span class="form__line"></span>
                        @error('login')
                            <div class="form__alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form__field">
                    <div class="form__input-box">
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ $user->email }}" 
                            required>
                        <label for="email" class="form__label">E-mail</label>
                        <span class="form__line"></span>
                        @error('email')
                            <div class="form__alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form__field">
                    <div class="form__input-box">
                        <input 
                        type="password" 
                        name="password" 
                        required>
                        <label for="password" class="form__label">Senha</label>
                        <span class="form__line"></span>
                        @error('password')
                            <div class="form__alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form__field">
                    <div class="form__input-box">
                        <input 
                            type="password" 
                            name="confirm_password" 
                            required>
                        <label for="password" class="form__label">Confirmar senha</label>
                        <span class="form__line"></span>
                        @error('confirm_password')
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
    <x-footer />
</x-layout>