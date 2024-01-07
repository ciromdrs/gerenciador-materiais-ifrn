<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

    <div class="container text-center" style="margin-top: 200px;">

        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Redirecionando...</span>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/js.cookie.js"></script>
    <script src="js/client.js"></script>
    {{-- <script src="js/settings.js"></script> --}}
    <script>
      var suap = new SuapClient(
        "{{ config('suap.uri') }}",
        "{{ config('suap.client_id') }}",
        "{{ config('suap.redirect_uri') }}", 
        "{{ config('suap.scope') }}"
      );
      suap.init();

      // if (suap.isAuthenticated()) {
      
        $(document).ready(function () {
          // Token de autenticação do SUAP
          const suapToken = suap.getToken().getValue();
          // Token CSRF fornecido pelo Laravel
          const csrfToken = document.getElementsByName('_token')[0].value;
          
          // Envia a o token do SUAP para o callback
          $.ajax({
            url: '/authorization-callback',
            data: {
              '_token' : csrfToken,
              'suap_token' : suapToken,
            },
            type: 'POST',
            success: function(response) {
              window.location='/painel'
            },
            error: function(response) {
              alert('Falha na comunicação com o servidor');
              console.log(response);
            }
          });
        });

        // Aguarda o documento carregar para exibir o conteúdo
      // }
      
      //  else {
      //   // O usuário não está autenticado
      //   alert('A autenticação via SUAP falhou.');
      //   window.location = "{{route('home')}}";
      // }

    </script>
    @csrf <!-- Necessário para evitar ataques CSRF, não remova -->
  </body>
</html>
