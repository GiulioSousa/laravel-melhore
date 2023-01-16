<x-layout title="{{ $title }}" :style="$style">
    <x-header :login="$user->login" :home="$home" />
    <main class="main-container card-container">
        <section class="section card">
            <h3 class="section-title">Informações da conta</h3>
            <div class="account__container">
                <img src="{{ asset('img/profile/profile-blank.png') }}" alt="" class="account__profile">
                <div class="account__field">
                    <h3 class="account__title">Nome de usuário</h3>
                    <p class="account__description">{{ $user->login }}</p>
                </div>
                <div class="account__field">
                    <h3 class="account__title">E-mail</h3>
                    <p class="account__description">{{ $user->email }}</p>
                </div>
            </div>
            <div class="btn-form__container">
                <a href="{{ route('account.edit') }}" class="card btn-form">Editar Perfil</a>
            </div>
        </section>
    </main>
    <x-footer />
</x-layout>