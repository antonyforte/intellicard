<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- CSS -->
    <link href="{{ asset('/css/styles.css')}}" rel="stylesheet">
    
    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="/js/script.js"></script>


    
    <!-- ROBOTO FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- ROBOTO CONDENSED FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- POPPINS FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- IKARUS FONT -->
    <link href="{{ asset('/css/fonts/Ikaros.css')}}" rel="stylesheet">

</head>
<body>
    <main>
        <div class="div-1">
            <div class="user-links">
                <img src="{{ asset('/icons/User.png') }}"></img>
                <h1>{{ Auth::user()->name }}</h1>
            </div>
            
            <div class="dashboard-links">
                <div class="dhome-link">
                    <img src="{{ asset('/icons/Home.png') }}"></img>
                    @if($homelink)
                        <p style="color: azure;">Home</p>                
                    @else
                    <a href="{{ route('dashboard') }}" >Home</a>
                    @endif                
                </div>
                <div class="chome-link">
                    <img src="{{ asset('/icons/Deck.png') }}"></img>
                    @if($decklink)
                        <p style="color: azure;">Decks</p>
                    @else
                        <a href="{{ route('list') }}">Decks</a>
                    @endif      
                </div>          
                <div class="logout-link">
                    <img src="{{ asset('/icons/Logout.png') }}"></img>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="logout-link-button"type="submit">Logout</button>
                    </form>
                </ul>
                </div>      
            </div>
            
        </div>
        <div class="div-2">
            @yield('content')
        </div>
    </main>
    <footer>
    <p>Ai-card &copy; 2024</p>
    </footer>
</body>
</html>
