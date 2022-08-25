<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">



        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div>
            <div class="relative bg-black pb-32 overflow-hidden">
                <div class="min-h-screen bg-gray-100">
                    <div class="bg-black">
                        @livewire('navigation-menu')
                    </div>

                    <!-- Page Heading -->
                    @if (isset($header))
                        <div class="relative bg-gray-100 pb-32 overflow-hidden">
                            <header class="relative py-10">
                                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                    <div class="md:flex md:items-center md:justify-between">
                                        <div class="flex-1 min-w-0">
                                            <h1 class="text-3xl font-bold text-gray-900">
                                                {{ $header }}
                                            </h1>
                                        </div>
                                        <div class="mt-4 flex md:mt-0 md:ml-4 space-x-1">
                                            @isset($headerLinks)
                                                {{ $headerLinks }}
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </header>
                        </div>
                    @endif

                    <!-- Page Content -->
                    <main class="relative -mt-32">
                        <div class="max-w-screen-xl mx-auto pb-6 px-4 sm:px-6 lg:pb-16 lg:px-8">
                            {{ $slot }}
                        </div>
                    </main>
                </div>
            </div>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
