<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title")</title>

    {{-- CSS DO APP --}}
    <link rel="stylesheet" href="/css/reset.css">

    {{-- BOOTSTRAP e CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">


    {{-- FONTES GOOGLE --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&family=Roboto" </head>

    <header>
        <nav class="navbar  navbar-dark bg-dark">
            <img src="/img/gestão-de-promoters-1-8-1.png" class="imagem" alt="" srcset="">
            <ul class="nav justify-content-end">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="/events/create">Criar Evento</a>
                </li>
                @auth
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="/dashboard">Meus Eventos</a>
                    </li>
                    <li class="nav-item">
                        <form action="/logout" method="POST">
                            @csrf
                            <a href="/logout" class="nav-link text-white" onclick="event.preventDefault();
                            this.closest('form').submit();">
                                Sair
                            </a>
                        </form>
                    </li>
                @endauth
                @guest
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="/register">Cadastrar</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="/login">Entrar</a>
                    </li>
                @endguest
            </ul>
        </nav>
    </header>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<body>

    <hr>

    <main>
        <div class="container-fluid">
            <div class="row">
                @if (session('msg'))
                    <p class="msg">{{ session('msg') }}</p>
                @endif
                @yield("content")
            </div>
        </div>
    </main>

    <footer class="text-center">
        <p>HDC Events &copy; 2022</p>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
