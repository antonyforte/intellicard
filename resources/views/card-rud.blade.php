<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
  <!-- CSS -->
  <link href="{{ asset('/css/card-creation-styles.css')}}" rel="stylesheet">
  
  <!-- Javascript -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="/js/script.js"></script>

  <!-- ROBOTO FONT -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">

  <!-- ROBOTO CONDENSED FONT -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">

  <!-- POPPINS FONT -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

  <!-- IKARUS FONT -->
  <link href="{{ asset('/css/fonts/Ikaros.css')}}" rel="stylesheet">
</head>

<body>
    <main>
        <div class="card-creation-title">
          <h3>Atualizar Cartão</h3>
        </div>
        <form method="POST" action="{{ route('card.update', $card->id) }}">
          @csrf
          @method('PUT')
          <div class="container m-auto mt-5">

            <!-- Tabela de cartões -->
            <table class="table custom-table">
              <thead>
                <tr>
                  <th>Cartão</th>
                  <th>Deck</th>
                  <th>Categoria</th>
                </tr>
              </thead>
              <tbody id="cardTableBody">
                  <tr>
                    <td>
                      <button type="button" class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#addCardModal">                                                    <img src="{{ asset('icons/edit2.png') }}" alt="delete">
                      </button>
                      <div id="card-container2">            
                        <div class="flip-card-click">
                          <div class="flip-card-inner" tab-index="0">
                            <div class="flip-card-front">
                              <h2>F: {{ $card->front }}</h2>
                            </div>
                            <div class="flip-card-back">
                              <p><b>B:</b> {{ $card->back }}</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="select">
                        <select class="deck-select">
                          <option value="" selected>Sem Deck</option>
                          @foreach ($decks as $deck)
                            @if($deck->id == $card->deck_id)
                                <option value="{{ $deck->id }}" selected>{{ $deck->name }}</option>
                            @else
                                <option value="{{ $deck->id }}">{{ $deck->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </td>
                    <td>
                      <div class="select">
                        <select class="category-select">
                          <option value="" selected>Sem Categoria</option>
                          @foreach ($categories as $category)
                            @if($category->id == $card->category_id)
                                <option value="{{ $category->id }}" selected>{{ $category->class }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->class }}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </td>
                  </tr>
              </tbody>
            </table>
          </div>
    
          <div class="ending-container">
            <button type="submit" id="reload-response" class="btn btn-primary " style="width: 120px; height: 50px; background-color: #0785da">Atualizar</button>
            <button type="button" class="btn btn-danger" style="width: 130px; height: 50px; background-color: #b91414; " data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Excluir Cartão</button>

        </div>
          <input type="hidden" id="cardData" name="cards">
        </form>
        <!-- Modal para adicionar cartão -->
        <div class="modal fade" id="addCardModal" tabindex="-1" aria-labelledby="addCardModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title" id="addCardModalLabel" style="color: #1b1b1c; font-family: "Roboto"">Modificar Cartão</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form id="addCardForm">
                    <div class="mb-3">
                        <label for="front" class="form-label">Front</label>
                        <input type="text" class="form-control" id="front" placeholder="Digite aqui o Front do cartão" value="{{ $card->front }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="back" class="form-label">Back</label>
                        <input type="text" class="form-control" id="back" placeholder="Digite aqui o Back do cartão" value="{{ $card->back }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
              </div>
            </div>
          </div>
        </div>
                <!-- Modal de confirmação de exclusão -->
                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteModalLabel" style="color: #1b1b1c">Confirmar Exclusão</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5 style="color: #1b1b1c">Tem certeza de que deseja excluir este cartão?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="{{ route('card.delete', $card->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    
      </main>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
            function assignButtonEvents() {
                // Handle button clicks
                document.querySelectorAll('.btn-danger').forEach(button => {
                    button.addEventListener('click', function(event) {
                        // Handle danger button click
                        const row = event.target.closest('tr');
                        row.remove();
                        updateCardData(); // Update card data when a row is deleted
                    });
                });
        
                // Attach change event listeners to deck-select and category-select elements
                document.querySelectorAll('.deck-select, .category-select').forEach(select => {
                    select.addEventListener('change', updateCardData);
                });
            }
        
            function updateCardData() {
                const rows = document.querySelectorAll('#cardTableBody tr');
                const cards = [];
                rows.forEach(row => {
                    const front = row.querySelector('.flip-card-front h2').textContent.replace('F: ', '');
                    const back = row.querySelector('.flip-card-back p').textContent.replace('B: ', '');
                    const deckId = row.querySelector('.deck-select').value;
                    const categoryId = row.querySelector('.category-select').value;
                    cards.push({ front: front, back: back, deck_id: deckId, category_id: categoryId });
                });
                document.getElementById('cardData').value = JSON.stringify(cards);
            }
        
            document.getElementById('addCardForm').addEventListener('submit', function(event) {
                event.preventDefault();
        
                // Remove all rows from the table
                document.getElementById('cardTableBody').innerHTML = '';
        
                const front = document.getElementById('front').value;
                const back = document.getElementById('back').value;
                const tableBody = document.getElementById('cardTableBody');
                const newRow = tableBody.insertRow();
        
                const cell2 = newRow.insertCell(0);
                const cell3 = newRow.insertCell(1);
                const cell4 = newRow.insertCell(2);
        
                cell2.innerHTML = `
                    <div id="card-container2">
                        <div class="flip-card-click">
                            <div class="flip-card-inner" tab-index="0">
                                <div class="flip-card-front">
                                    <h2>F: ${front}</h2>
                                </div>
                                <div class="flip-card-back">
                                    <p><b>B:</b> ${back}</p>
                                </div>
                            </div>
                        </div>
                    </div>`;
                cell3.innerHTML = `
                    <div class="select">
                        <select class="deck-select">
                            <option value="" selected>Sem Deck</option>
                            @foreach ($decks as $deck)
                            @if($deck->id == $card->deck_id)
                            <option value="{{ $deck->id }}" selected>{{ $deck->name }}</option>
                            @else
                            <option value="{{ $deck->id }}">{{ $deck->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>`;
                cell4.innerHTML = `
                    <div class="select">
                        <select class="category-select">
                            <option value="" selected>Sem Categoria</option>
                            @foreach ($categories as $category)
                            @if($category->id == $card->category_id)
                            <option value="{{ $category->id }}" selected>{{ $category->class }}</option>
                            @else
                            <option value="{{ $category->id }}">{{ $category->class }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>`;
        
                updateCardData(); // Update card data when a new row is added
        
                const modal = bootstrap.Modal.getInstance(document.getElementById('addCardModal'));
                modal.hide();
                document.getElementById('addCardForm').reset();
                assignButtonEvents(); // Re-assign button events after adding a new row
            });
        
            assignButtonEvents();
        });
        </script>
        
</body>
</html>
