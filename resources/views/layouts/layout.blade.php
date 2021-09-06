<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }} - @yield('title')</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://kit.fontawesome.com/badf7f3a33.js" crossorigin="anonymous"></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        @yield('CSS')
    </head>

    <body>
        <div id="mainContainer">
            @include('partials.sidebar')

            <main id="content" class="my-3">
                <div class="container-fluid">
                    @if (Session::has('message') || Session::has('error'))
                        @include('partials.flash-message')
                    @endif
                    @yield('content')
                </div>
            </main>
        </div>

        <footer style="	background-color: rgb(34, 33, 33);
      padding: 20px;
      position: fixed;
      top: auto;
      bottom: 0;
      width: 100%;" class="sticky-footer bg-darkk">
            <div class="container my-auto">
              <div class="copyright text-center my-auto">
                <span style="color: white">Copyright &copy; BitChest by said Lounnas</span>
              </div>
            </div>
          </footer>
        {{-- Scripts --}}
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js" defer></script>
        <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
        <script src="{{ asset('js/script.js') }}"></script>
        @yield('JS')
    </body>
</html>
