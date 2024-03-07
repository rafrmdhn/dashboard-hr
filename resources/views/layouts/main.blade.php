<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Dashboard HR | {{ $title }}</title>
</head>
<body>
    @include('partials.navbar')
    
    @include('partials.aside')

    @if (!request()->is('/'))
        @include('partials.header')
    @endif
    
    <div class="container max-w-full {{ Request::is('/') ? 'bg-gray-300' : '' }}">
        @yield('container')
    </div>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>