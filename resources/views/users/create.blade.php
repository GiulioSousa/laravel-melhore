<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ "Título da página" }}</title>
    {{ '$session[description] + <meta>description' }}
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login/login.css') }}">
</head>
<body>
    <main class="container">
        <section class="card">
            <form action="{{ route('users.store') }}" method="post" class="form">
                @csrf
                <h3 class="form__title">Área do Cliente</h3>
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
                        <input type="submit" value="Salvar" class="form__btn-submit">
                    </div>
                </div>
            </form>
        </section>
        <div class="bg-img bg-img--logo"></div>
        <div class="bg-img bg-img--simbolo"></div>
    </main>
</body>
</html>