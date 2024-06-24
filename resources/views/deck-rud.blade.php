<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>IntelliCard</title>

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
    <div class="container mt-5">
        <div style="display: flex; gap: 5%">
            <h2>{{ $deck->name }} Deck</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#editDeckModal">
              <img src="{{ asset('icons/edit2.png') }}" alt="edit">
            </button>
        </div>
        
        <div class="table-responsive mt-3">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Front</th>
                <th>Back</th>
                <th>Category</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($cards as $index => $card)
              <tr>
                <td>{{ $card->front }}</td>
                <td>{{ $card->back }}</td>
                <td>{{ $categories[$index]->class }}</td>
                <td>
                  <!-- Button to trigger card removal modal -->
                  <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmRemoveModal{{$index}}">Remover</button>
                </td>
              </tr>
              <!-- Modal for Confirming Card Removal -->
              <div class="modal fade" id="confirmRemoveModal{{$index}}" tabindex="-1" aria-labelledby="confirmRemoveModalLabel{{$index}}" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="confirmRemoveModalLabel{{$index}}" style="color: #1b1b1c">Remover Cartão do Deck</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <h5 style="color: #1b1b1c">Você tem certeza em remover este cartão do deck ?</h5>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <!-- Form to submit removal of card -->
                      <form method="POST" action="{{ route('deck.update.remove.card', ['deck_id' => $deck->id, 'card_id' => $card->id]) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger">Remover</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </tbody>
          </table>
        </div>
        <div style="display: flex; margin-bottom: 10%; margin-top: 5%; gap: 50%">
          <a href="/list" class="btn btn-secondary">Voltar</a>
          <!-- Button to trigger deck deletion modal -->
          <button type="button" class="btn btn-danger ml-2" data-bs-toggle="modal" data-bs-target="#confirmDeleteDeckModal">Apagar Deck</button>
        </div>
    </div>       

    <!-- Modal for Editing Deck Name -->
    <div class="modal fade" id="editDeckModal" tabindex="-1" aria-labelledby="editDeckModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editDeckModalLabel" style="color: #1b1b1c">Alterar Nome do Deck</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" action="{{ route('deck.update', $deck->id) }}">
            @csrf
            @method('PUT')
            <div class="modal-body">
              <div class="form-group">
                <label for="deck_name">Deck Name</label>
                <input type="text" class="" id="deck_name" name="name" value="{{ $deck->name }}">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Alterar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal for Confirming Deck Deletion -->
    <div class="modal fade" id="confirmDeleteDeckModal" tabindex="-1" aria-labelledby="confirmDeleteDeckModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmDeleteDeckModalLabel" style="color: #1b1b1c">Remover Deck</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p style="color: #a10a0a">Deseja realmente apagar esse Deck ? Esta ação é irreversível</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <!-- Form to submit deck deletion -->
            <form method="POST" action="{{ route('deck.delete', $deck->id) }}">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Deletar</button>
            </form>
          </div>         
      </div>
    </div>
  </div
