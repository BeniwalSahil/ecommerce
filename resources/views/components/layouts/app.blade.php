<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'SKB BENIWAL' }}</title>
        @vite(['resources/css/app.css','resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-white text-black">
      @livewire('partials.navbar')
        <main>
            {{ $slot }}
        </main>
        @livewire('partials.footer')
    </body>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- <x-livewire-alert::scripts/> --}}
</html>
