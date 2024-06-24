@extends('layouts.main')
@section('title', 'IntelliCard')

@php
    $decklink = false;
    $homelink = true;
@endphp

@section('content')
    <div class="dashboard-container">
        <div class="dashboard-title">
            <h1>Categorias</h1>
        </div>
        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('/icons/add.png') }}" style="width: 40px; height: 40px;"></img>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('card-creation') }}">Criar Cartão</a></li>
              <li><a class="dropdown-item" href="{{ route('ia-card-creation') }}">Criar Cartão com IA</a></li>
              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdropp">Criar Deck</a></li>
              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Criar Categoria</a></li>
            </ul>
        </div>

        <!-- Deck Modal -->
        <div class="modal fade" id="staticBackdropp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Criar Categoria</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form-container" action="{{ route('deck.create') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="25" placeholder="Digite o nome do Deck...">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                      <button type="submit" class="btn btn-success">Criar</button>
                    </div>
                </form>   
              </div>
            </div>
        </div>

        <!-- Category Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Criar Categoria</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form-container" action="{{ route('category.create') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="class" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="45" placeholder="Digite o nome da Categoria...">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                      <button type="submit" class="btn btn-success">Criar</button>
                    </div>
                </form>   
              </div>
            </div>
        </div>

        <div class="dashboard-nav" id="navbar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" id="breadcrumb">
                  <li class="breadcrumb-item"><a href="#" id="homeBreadcrumb">Home</a></li>
                </ol>
            </nav>
        </div>

        <div class="dashboard-main">
            @foreach($categories as $category)
                <div class="accordion accordion-flush" id="accordionExample">
                    <div class="accordion-item border-0">
                        <h1 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}" aria-expanded="false" aria-controls="collapse{{ $category->id }}" onclick="updateBreadcrumb('{{ $category->class }}', null)">
                                <h1>{{ $category->class }}</h1>
                            </button>
                        </h1>
                        <div id="collapse{{ $category->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="cards-list">
                                    @foreach($cards as $card)
                                        @if($card->category_id == $category->id)
                                        <div class="card" onclick="updateBreadcrumb('{{ $category->class }}', '{{ $card->front }}')">
                                            <div class="card_image">
                                                <button onclick="window.location.href='/dashboard/card/{{$card->id}}'" class="btn btn-primary" style="position: absolute;height: 35px; width: 40px ; z-index: 1000; border-radius: 10px; background-color: #040721">
                                                    <img src="{{ asset('icons/edit.png') }}" alt="delete" style="height: 25px; width: 25px; position: relative; left: -5px; bottom 5px">
                                                </button>
                                                <button class="btn btn-primary expand-btn" style="position: absolute;height: 35px; width: 40px ; z-index: 1000; border-radius: 10px; background-color: #040721; margin-left: 160px; margin-top: 165px">
                                                    <img src="{{ asset('icons/expand.png') }}" alt="expand" style="height: 25px; width: 25px; position: relative; left: -5px; bottom: 2px">
                                                </button>                                                
                                                <div id="card-container2">
                                                    <div class="flip-card-click">
                                                      <div class="flip-card-inner" tab-index="0">
                                                        <div class="flip-card-front">
                                                          <h2>F: {{ $card['front'] }}</h2>
                                                        </div>
                                                        <div class="flip-card-back">
                                                          <p><b>B:</b> {{ $card['back'] }}</p>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>                                            
                                                </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Cards without category -->
            <div class="accordion accordion-flush" id="accordionExample">
                <div class="accordion-item border-0">
                    <h1 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNoCategory" aria-expanded="false" aria-controls="collapseNoCategory" onclick="updateBreadcrumb('Sem Título', null)">
                            <h1>Sem Título</h1>
                        </button>
                    </h1>
                    <div id="collapseNoCategory" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="cards-list">
                                @foreach($cards as $card)
                                    @if($card->category_id == null)
                                        <div class="card" onclick="updateBreadcrumb('Sem Título', '{{ $card->front }}')">
                                            <div class="card_image">
                                                <button onclick="window.location.href='/dashboard/card/{{$card->id}}'" class="btn btn-primary" style="position: absolute;height: 35px; width: 40px ; z-index: 1000; border-radius: 10px; background-color: #040721">
                                                    <img src="{{ asset('icons/edit.png') }}" alt="delete" style="height: 25px; width: 25px; padding-right: 8px;">
                                                </button>
                                                <button class="btn btn-primary expand-btn" style="position: absolute;height: 35px; width: 40px ; z-index: 1000; border-radius: 10px; background-color: #040721; margin-left: 160px; margin-top: 165px">
                                                    <img src="{{ asset('icons/expand.png') }}" alt="expand" style="height: 25px; width: 25px; position: relative; left: -5px; bottom: 2px">
                                                </button> 
                                                <div id="card-container2">
                                                    <div class="flip-card-click">
                                                      <div class="flip-card-inner" tab-index="0">
                                                        <div class="flip-card-front">
                                                          <h2>F: {{ $card['front'] }}</h2>
                                                        </div>
                                                        <div class="flip-card-back">
                                                          <p><b>B:</b> {{ $card['back'] }}</p>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>                                            
                                                </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="cardModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div id="modalCardContainer">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        var modal = document.getElementById("cardModal");
        var span = document.getElementsByClassName("close")[0];

        document.querySelectorAll(".expand-btn").forEach(function(button) {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                var cardContent = this.closest(".card").querySelector(".flip-card-click").innerHTML;
                document.getElementById("modalCardContainer").innerHTML = '<div class="flip-card-click">' + cardContent + '</div>';
                modal.style.display = "block";
            });
        });

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });

    </script>
    <script>
        document.addEventListener('scroll', function() {
            const breadcrumb = document.querySelector('.breadcrumb');
            const scrollDistance = 135; 
            if (window.scrollY >= scrollDistance) {
                breadcrumb.classList.add('fixed');
            } else {
                breadcrumb.classList.remove('fixed');
            }
        });
    </script>

    <script>
        function updateBreadcrumb(category, card) {
            let breadcrumb = document.getElementById('breadcrumb');
            breadcrumb.innerHTML = '';
            
            let homeCrumb = document.createElement('li');
            homeCrumb.className = 'breadcrumb-item';
            let homeLink = document.createElement('a');
            homeLink.href = '#';
            homeLink.innerText = 'Home';
            homeLink.onclick = function() { updateBreadcrumb(null, null); };
            homeCrumb.appendChild(homeLink);
            breadcrumb.appendChild(homeCrumb);

            if (category) {
                let categoryCrumb = document.createElement('li');
                categoryCrumb.className = 'breadcrumb-item';
                categoryCrumb.innerText = category;
                breadcrumb.appendChild(categoryCrumb);
            }

            if (card) {
                let cardCrumb = document.createElement('li');
                cardCrumb.className = 'breadcrumb-item active';
                cardCrumb.setAttribute('aria-current', 'page');
                cardCrumb.innerText = 'Cartão';
                breadcrumb.appendChild(cardCrumb);
            }
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            updateBreadcrumb(null, null);
        });
    </script>
@endsection
