<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="/js/script.js"></script>

    {{-- fonte do texto --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,500&family=Roboto&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
</head>

<body style="background-color: #fffeff">
    <header>
        <nav class="navbar">
            <div class="container_list">
                <a href="/">
                    <img src="/img/hdcevents_logo.svg" alt="logo HdcEvents" id="logoHdc">
                </a>
                <ul>
                    <li>
                        <a href="/">Eventos</a>
                    </li>
                    <li>
                        <a href="/events/create">Criar eventos</a>
                    </li>
                    @auth
                        <li>
                            <a href="/dashboard">Meus eventos</a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" id="formLoggout">
                                @csrf
                                <button type="submit" id="btnLoggout" class="bg-blue-300">Sair</button>
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li>
                            <a href="/login">Entrar</a>
                        </li>
                        <li>
                            <a href="/register">Cadastrar</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </header>
    @if (session('success'))
        <p id="success">{{ session('success') }}</p>
    @endif
    @if (session('error'))
    <p id="error">{{ session('error') }}</p>
@endif
    @yield('content')
    <footer>
        <p>Hdc Events &copy;2023</p>
    </footer>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>
