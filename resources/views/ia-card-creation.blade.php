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

    <main class="card-creation-main">

      <div class="card-creation-title">
        <h3>Criar Cartão com IA</h3>
      </div>

      <div class="text-area-containers">

        <form class="form-container" action="{{ route('cardai.send') }}" method="POST" id="card-creation-form">
          @csrf
          <div class="card-creation-container">
            <div class="input-group">
              <textarea name="user-text" class="form-control" aria-label="With textarea" placeholder="Cole um Texto para que a IA gere os cartões...">@isset($usertext){{ $usertext }}@endisset</textarea>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <img src="{{ asset('icons/double-arrow-icon.png') }}" style="width: 80px; height: 60px; align-self: center; margin: 0% 1% 0% 1%;">
  
        <div class="ia-response-container">
          <div class="input-group">
            <textarea class="form-control" aria-label="With textarea" placeholder="Resultado da IA...">@isset($response){{ $response }}@endisset</textarea>
          </div>

          <div class="ia-buttons">


            <form id="send-response-form" action="{{ route('cardai.create') }}" method="POST" style="display:inline;">
              @csrf
              <input type="hidden" name="response" id="response-text">
              <button type="submit" class="btn btn-primary send" style="height: 50px; width: 70px;">
                <img src="{{ asset('icons/next.png') }}" alt="next" style="height: 35px; width: 35px">
              </button>
            </form>
          </div>
          
        </div>
      </div>

      <!-- Loading Spinner -->
      <div id="loading" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%);">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>

    </main>

    <script>
      $(document).ready(function() {
        // Handle form submission
        $('#card-creation-form').on('submit', function(e) {
          e.preventDefault();
          sendFormData();
        });
    
        // Handle reload button click
        $('#reload-response').on('click', function(e) {
          e.preventDefault();
          sendFormData();
        });
    
        // Function to send form data via AJAX
        function sendFormData() {
          // Show the loading spinner
          $('#loading').show();
    
          var formData = $('#card-creation-form').serialize();
    
          $.ajax({
            url: $('#card-creation-form').attr('action'), // The URL to send the data to
            type: 'POST',
            data: formData,
            success: function(data) {
              // Hide the loading spinner
              $('#loading').hide();
    
              // Update the response textarea with the JSON response data
              $('.ia-response-container textarea').val(data.response);
    
              // Additional logic for handling the response
            },
            error: function(xhr, status, error) {
              // Hide the loading spinner
              $('#loading').hide();
    
              // Handle errors
              alert('Ocorreu um erro ao enviar os dados.');
            }
          });
        }
    
        // Handle send button click
        $('#send-response-form').on('submit', function(e) {
          // Set the hidden input field's value to the textarea content
          $('#response-text').val($('.ia-response-container textarea').val());
        });
      });
    </script>
    

    

  </body>
</html>
