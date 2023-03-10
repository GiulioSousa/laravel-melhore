<x-layout title="Painel administrativo | Melhore" :style="$style">
    <x-header :login="$user->login" :home="$home" :avatar="$user->avatar" />
    <main class="main-container">
        <x-message />
        <ul class="client-list">
            @foreach ($clients as $client)
                <li class="client-card card">
                    <a href="{{ route('client-info.index', $client->id) }}" class="client-card__link">
                        <img src="@if (!is_null($client->avatar))
                        {{ asset('storage/' . $client->avatar) }}
                        @else
                        {{ asset('storage/img/profile-avatar/profile-blank.png') }}
                        @endif" alt="" class="client-card__img">
                        <h3 class="client-card__title">{{ $client->login }}</h3>
                        <span class="client-card__description">Clique para mais informações</span>
                    </a>
                </li>  
            @endforeach
            <li class="client-card client-card--new card">
                <a href="{{ route('account.create') }}" class="client-card__link">
                    <img src="{{ asset('storage/img/profile-avatar/profile-blank.png') }}" alt="" class="client-card__img">
                    <h3 class="client-card__title">Novo Cliente</h3>
                </a>
            </li>
        </ul>
    </main>
    <x-footer />
</x-layout>