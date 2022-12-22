<x-layout title="Painel administrativo | Melhore">
    <x-header/>
    <main class="main-container">
        <ul class="client-list">
            @foreach ($clients as $client)
                <li class="client-card card">
                    <a href="/cliente-info?id={{ $client->id }}" class="client-card__link">
                        <img src="/assets/img/photo" alt="" class="client-card__img">
                        <h3 class="client-card__title">{{ $client->login }}</h3>
                        <span class="client-card__description">Clique para mais informações</span>
                    </a>
                </li>
                
            @endforeach
            <li class="client-card client-card--new card">
                <a href="/novo-cliente" class="client-card__link">
                    <img src="/assets/img/profile-blank.png" alt="" class="client-card__img">
                    <h3 class="client-card__title">Novo Cliente</h3>
                </a>
            </li>
        </ul>
    </main>
    <x-footer/>
</x-layout>