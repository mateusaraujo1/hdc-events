<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <!-- CSS bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- CSS da aplicação -->
    <link rel="stylesheet" href="/css/welcome/index.css">
    <link rel="stylesheet" href="/css/welcome/search.css">
    <link rel="stylesheet" href="/css/welcome/navbar.css">
    <link rel="stylesheet" href="/css/welcome/event.css">
    <link rel="stylesheet" href="/css/welcome/footer.css">
    <link rel="stylesheet" href="/css/create/create.css">
    <link rel="stylesheet" href="/css/show/show.css">
    <link rel="stylesheet" href="/css/dashboard/dashboard.css">
    <link rel="stylesheet" href="/css/edit/edit.css">
    
    <script src="/js/script.js"></script>

    <!-- Styles -->
</head>

<body>
     <header>
        <nav class="navbar navbar-expand navbar-light">
          <div class="collapse navbar-collapse" id="navbar">
            <a href="/" class="navbar-brand">
              <img src="/img/hdcevents_logo.svg" alt="HDC Events">
            </a>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a href="/" class="nav-link">Eventos</a>
              </li>
              <li class="nav-item">
                <a href="/events/create" class="nav-link">Criar Eventos</a>
              </li>

              @auth
              <li class="nav-item">
                <a href="/dashboard" class="nav-link">Meus Eventos</a>
              </li>
              <li class="nav-item">
                <form action="/logout" method="POST">
                  @csrf
                  <a href="/logout" 
                     class="nav-link" 
                     onclick="event.preventDefault();this.closest('form').submit();">Sair</a>
                </form>
              </li>
              @endauth
                
              @guest
              <li class="nav-item">
                <a href="/login" class="nav-link">Entrar</a>
              </li>
              <li class="nav-item">
                <a href="/register" class="nav-link">Cadastrar</a>
              </li>
              @endguest
            </ul>
          </div>
        </nav>
      </header>

    <main>
      <div class="container-fluid">
        <div class="row">

          @if(session('msg'))
            <p class="msg"> {{ session('msg') }}</p>
          @endif

          @yield('content')
          
        </div>
      </div>
    </main>

    <footer>
        <p>HDC Events &@copy; 2020</p>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>
