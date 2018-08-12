<!DOCTYPE html>
<html lang="en">
<head>
   
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>
   
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>


    
    <div id="app">
       
        @include('inc.navbar')
        <div class="container">
        <main class="py-4">
                @include('inc.messages')
            @yield('content')
         
        </main>

        </div>


    </div>

</body>
</html>
