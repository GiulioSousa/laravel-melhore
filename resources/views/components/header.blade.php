<header class="header">
    <img src="{{ asset('img/logo-transp.png') }}" alt="" class="header__logo" id="logo-transp">
    <img src="{{ asset('img/logo-color.png') }}" alt="" class="header__logo header__logo--invisible" id="logo-color">
    <ul class="menu__list">
        <li>
            <a class="menu__link" id="menu-inicio" href="{{ route($home) }}">Home</a>
        </li>
        <li>
            <a class="menu__link" id="menu-laudo" href="{{ route('account.index') }}">Informações da conta</a>
        </li>
        <li>
            <a class="menu__link" href="/logout">Sair</a>
        </li>
    </ul>
    <div class="header-profile">
        <p class="header-profile__name">{{ $login }}</p>
        <img src="{{ asset('img/profile/profile-blank.png') }}" alt="" class="header-profile__avatar">
    </div>
</header>
<button class="header__menu card">
    <span class="menu-ic"></span>
    <span class="menu-ic"></span>
    <span class="menu-ic"></span>
</button>
<nav class="lateral-menu">
    <ul class="lateral-menu__list">
        <li class="card">
            <a class="lateral-menu__link" id="menu-inicio" href="#">Home</a>
        </li>
        <li class="card">
            <a class="lateral-menu__link" id="menu-laudo" href="/info-conta">Informações da conta</a>
        </li>
        <li class="card">
            <a class="lateral-menu__link" href="/logout">Sair</a>
        </li>
    </ul>
</nav>
</header>