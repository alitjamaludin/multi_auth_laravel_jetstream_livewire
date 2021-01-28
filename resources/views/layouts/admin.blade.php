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

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet"> <!--Replace with your tailwind.css once created-->
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet"> <!--Totally optional :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            <nav x-data="{ open: false }" class="fixed top-0 z-20 w-full h-auto px-1 pt-2 pb-1 mt-0 bg-gradient-to-r from-purple-900 to-gray-800 md:pt-1">
                <!-- Primary Navigation Menu -->
                <div class="px-4 mx-auto sm:px-6 lg:px-8">
                    <div class="flex justify-between h-15">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex items-center flex-shrink-0">
                                <a href="{{ route('admin.dashboard') }}">
                                    <x-jet-application-mark class="block w-auto h-9" />
                                </a>
                            </div>

                            <!-- Navigation Links -->
                            {{-- <div class="hidden ml-4 space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <x-jet-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                                    <div class="text-white">{{ __('Dashboard') }}</div>
                                </x-jet-nav-link>
                            </div> --}}
                        </div>

                        {{-- search --}}
                        <div class="flex justify-end flex-1 max-w-xl px-2 mt-1 text-white md:w-1/3">
                            <span class="relative w-full">
                                <input type="search" placeholder="Search" class="w-full px-2 py-3 pl-10 leading-normal text-white transition border border-transparent rounded appearance-none bg-gradient-to-r from-purple-600 to-gray-500 focus:outline-none focus:border-pink-700">
                                <div class="absolute search-icon" style="top: 1rem; left: .8rem;">
                                    <svg class="w-4 h-4 text-white pointer-events-none fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                                    </svg>
                                </div>
                            </span>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Teams Dropdown -->
                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                <div class="relative ml-3">
                                    <x-jet-dropdown align="right" width="60">
                                        <x-slot name="trigger">
                                            <span class="inline-flex rounded-md">
                                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                                                    {{ Auth::user()->currentTeam->name }}

                                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </x-slot>

                                        <x-slot name="content">
                                            <div class="w-60">
                                                <!-- Team Management -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    {{ __('Manage Team') }}
                                                </div>

                                                <!-- Team Settings -->
                                                <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                                    {{ __('Team Settings') }}
                                                </x-jet-dropdown-link>

                                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                    <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                                        {{ __('Create New Team') }}
                                                    </x-jet-dropdown-link>
                                                @endcan

                                                <div class="border-t border-gray-100"></div>

                                                <!-- Team Switcher -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    {{ __('Switch Teams') }}
                                                </div>

                                                @foreach (Auth::user()->allTeams() as $team)
                                                    <x-jet-switchable-team :team="$team" />
                                                @endforeach
                                            </div>
                                        </x-slot>
                                    </x-jet-dropdown>
                                </div>
                            @endif

                            <!-- Settings Dropdown -->
                            <div class="relative ml-3">
                                <x-jet-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                            <button class="flex text-sm transition duration-150 ease-in-out border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                                <img class="object-cover rounded-full w-11 h-11" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                            </button>
                                        @else
                                            <span class="inline-flex rounded-md">
                                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                                    {{ Auth::user()->name }}

                                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </span>
                                        @endif
                                    </x-slot>

                                    <x-slot name="content">
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Account') }}
                                        </div>

                                        <x-jet-dropdown-link href="{{ route('profile.admin-show') }}">
                                            {{ __('Profile') }}
                                        </x-jet-dropdown-link>

                                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                            <x-jet-dropdown-link href="{{ route('api-tokens.admin-index') }}">
                                                {{ __('API Tokens') }}
                                            </x-jet-dropdown-link>
                                        @endif

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                     onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                                {{ __('Logout') }}
                                            </x-jet-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-jet-dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="flex items-center -mr-2 sm:hidden">
                            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                                <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <x-jet-responsive-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Dashboard') }}
                        </x-jet-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <div class="flex-shrink-0 mr-3">
                                    <img class="object-cover w-10 h-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </div>
                            @endif

                            <div>
                                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <!-- Account Management -->
                            <x-jet-responsive-nav-link href="{{ route('profile.admin-show') }}" :active="request()->routeIs('profile.admin-show')">
                                {{ __('Profile') }}
                            </x-jet-responsive-nav-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-responsive-nav-link href="{{ route('api-tokens.admin-index') }}" :active="request()->routeIs('api-tokens.admin-index')">
                                    {{ __('API Tokens') }}
                                </x-jet-responsive-nav-link>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </x-jet-responsive-nav-link>
                            </form>

                            <!-- Team Management -->
                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                <div class="border-t border-gray-200"></div>

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Team') }}
                                </div>

                                <!-- Team Settings -->
                                <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                                    {{ __('Team Settings') }}
                                </x-jet-responsive-nav-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                    <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                        {{ __('Create New Team') }}
                                    </x-jet-responsive-nav-link>
                                @endcan

                                <div class="border-t border-gray-200"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Switch Teams') }}
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                    <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <div class="flex flex-col md:flex-row">

                <div class="fixed bottom-0 z-10 w-full h-16 mt-12 shadow-xl bg-gradient-to-b from-purple-900 to-gray-800 md:relative md:h-screen md:w-48">

                    <div class="content-center justify-between py-16 text-left md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 md:content-start">
                        <ul class="flex flex-row px-1 py-0 text-center list-reset md:flex-col md:py-3 md:px-2 md:text-left">

                            <li class="flex-1 mr-3">
                                <a href="{{ route('admin.dashboard') }}" class="block py-1 pl-1 text-white no-underline align-middle border-b-2 border-gray-800 md:py-3 hover:text-white hover:border-green-500">
                                    <i class="pr-0 fas fa-tachometer-alt md:pr-3"></i><span class="block pb-1 text-xs text-gray-600 md:pb-0 md:text-base md:text-gray-400 md:inline-block">Dashboard</span>
                                </a>
                            </li>
                            <li class="flex-1 mr-3">
                                <a href="#" class="block py-1 pl-1 text-white no-underline align-middle border-b-2 border-gray-800 md:py-3 hover:text-white hover:border-pink-500">
                                    <i class="pr-0 fas fa-tasks md:pr-3"></i><span class="block pb-1 text-xs text-gray-600 md:pb-0 md:text-base md:text-gray-400 md:inline-block">Tasks</span>
                                </a>
                            </li>
                            <li class="flex-1 mr-3">
                                <a href="#" class="block py-1 pl-1 text-white no-underline align-middle border-b-2 border-gray-800 md:py-3 hover:text-white hover:border-purple-500">
                                    <i class="pr-0 fa fa-envelope md:pr-3"></i><span class="block pb-1 text-xs text-gray-600 md:pb-0 md:text-base md:text-gray-400 md:inline-block">Messages</span>
                                </a>
                            </li>
                            <li class="flex-1 mr-3">
                                <a href="#" class="block py-1 pl-1 text-white no-underline align-middle border-b-2 border-gray-800 md:py-3 hover:text-white hover:border-blue-600 ">
                                    <i class="pr-0 fas fa-chart-area md:pr-3"></i><span class="block pb-1 text-xs text-gray-600 md:pb-0 md:text-base md:text-gray-400 md:inline-block">Analytics</span>
                                </a>
                            </li>
                            <li class="flex-1 mr-3">
                                <a href="#" class="block py-1 pl-0 text-white no-underline align-middle border-b-2 border-gray-800 md:py-3 md:pl-1 hover:text-white hover:border-yellow-500">
                                    <i class="pr-0 fa fa-wallet md:pr-3"></i><span class="block pb-1 text-xs text-gray-600 md:pb-0 md:text-base md:text-gray-400 md:inline-block">Payments</span>
                                </a>
                            </li>
                        </ul>
                    </div>


                </div>

                <div class="flex-1 pb-24 mt-12 bg-gradient-to-r from-gray-300 to-gray-800 main-content md:mt-2 md:pb-5">

                    <div class="pt-3 mt-12 bg-gradient-to-r from-purple-900 to-gray-800">
                        <div class="p-4 text-2xl text-white shadow bg-gradient-to-r from-pink-900 to-gray-800 rounded-tl-3xl">
                            <h3 class="pl-2 font-bold">Dashboard</h3>
                        </div>
                    </div>

                    <div class="flex flex-wrap">
                        <div class="w-full p-6 md:w-1/2 xl:w-1/3">
                            <!--Metric Card-->
                            <div class="p-5 border-b-4 border-green-600 rounded-lg shadow-xl bg-gradient-to-b from-green-200 to-green-100">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink pr-4">
                                        <div class="p-5 bg-green-600 rounded-full"><i class="fa fa-wallet fa-2x fa-inverse"></i></div>
                                    </div>
                                    <div class="flex-1 text-right md:text-center">
                                        <h5 class="font-bold text-gray-600 uppercase">Total Revenue</h5>
                                        <h3 class="text-3xl font-bold">$3249 <span class="text-green-500"><i class="fas fa-caret-up"></i></span></h3>
                                    </div>
                                </div>
                            </div>
                            <!--/Metric Card-->
                        </div>
                        <div class="w-full p-6 md:w-1/2 xl:w-1/3">
                            <!--Metric Card-->
                            <div class="p-5 border-b-4 border-pink-500 rounded-lg shadow-xl bg-gradient-to-b from-pink-200 to-pink-100">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink pr-4">
                                        <div class="p-5 bg-pink-600 rounded-full"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                                    </div>
                                    <div class="flex-1 text-right md:text-center">
                                        <h5 class="font-bold text-gray-600 uppercase">Total Users</h5>
                                        <h3 class="text-3xl font-bold">249 <span class="text-pink-500"><i class="fas fa-exchange-alt"></i></span></h3>
                                    </div>
                                </div>
                            </div>
                            <!--/Metric Card-->
                        </div>
                        <div class="w-full p-6 md:w-1/2 xl:w-1/3">
                            <!--Metric Card-->
                            <div class="p-5 border-b-4 border-yellow-600 rounded-lg shadow-xl bg-gradient-to-b from-yellow-200 to-yellow-100">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink pr-4">
                                        <div class="p-5 bg-yellow-600 rounded-full"><i class="fas fa-user-plus fa-2x fa-inverse"></i></div>
                                    </div>
                                    <div class="flex-1 text-right md:text-center">
                                        <h5 class="font-bold text-gray-600 uppercase">New Users</h5>
                                        <h3 class="text-3xl font-bold">2 <span class="text-yellow-600"><i class="fas fa-caret-up"></i></span></h3>
                                    </div>
                                </div>
                            </div>
                            <!--/Metric Card-->
                        </div>
                        <div class="w-full p-6 md:w-1/2 xl:w-1/3">
                            <!--Metric Card-->
                            <div class="p-5 border-b-4 border-blue-500 rounded-lg shadow-xl bg-gradient-to-b from-blue-200 to-blue-100">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink pr-4">
                                        <div class="p-5 bg-blue-600 rounded-full"><i class="fas fa-server fa-2x fa-inverse"></i></div>
                                    </div>
                                    <div class="flex-1 text-right md:text-center">
                                        <h5 class="font-bold text-gray-600 uppercase">Server Uptime</h5>
                                        <h3 class="text-3xl font-bold">152 days</h3>
                                    </div>
                                </div>
                            </div>
                            <!--/Metric Card-->
                        </div>
                        <div class="w-full p-6 md:w-1/2 xl:w-1/3">
                            <!--Metric Card-->
                            <div class="p-5 border-b-4 border-indigo-500 rounded-lg shadow-xl bg-gradient-to-b from-indigo-200 to-indigo-100">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink pr-4">
                                        <div class="p-5 bg-indigo-600 rounded-full"><i class="fas fa-tasks fa-2x fa-inverse"></i></div>
                                    </div>
                                    <div class="flex-1 text-right md:text-center">
                                        <h5 class="font-bold text-gray-600 uppercase">To Do List</h5>
                                        <h3 class="text-3xl font-bold">7 tasks</h3>
                                    </div>
                                </div>
                            </div>
                            <!--/Metric Card-->
                        </div>
                        <div class="w-full p-6 md:w-1/2 xl:w-1/3">
                            <!--Metric Card-->
                            <div class="p-5 border-b-4 border-red-500 rounded-lg shadow-xl bg-gradient-to-b from-red-200 to-red-100">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink pr-4">
                                        <div class="p-5 bg-red-600 rounded-full"><i class="fas fa-inbox fa-2x fa-inverse"></i></div>
                                    </div>
                                    <div class="flex-1 text-right md:text-center">
                                        <h5 class="font-bold text-gray-600 uppercase">Issues</h5>
                                        <h3 class="text-3xl font-bold">3 <span class="text-red-500"><i class="fas fa-caret-up"></i></span></h3>
                                    </div>
                                </div>
                            </div>
                            <!--/Metric Card-->
                        </div>
                    </div>


                    <div class="flex flex-row flex-wrap flex-grow mt-2">

                        <div class="w-full p-6 md:w-1/2 xl:w-1/3">
                            <!--Graph Card-->
                            <div class="bg-white border-transparent rounded-lg shadow-xl">
                                <div class="p-2 text-gray-800 uppercase border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg bg-gradient-to-b from-gray-300 to-gray-100">
                                    <h5 class="font-bold text-gray-600 uppercase">Graph</h5>
                                </div>
                                <div class="p-5">
                                    <canvas id="chartjs-7" class="chartjs" width="undefined" height="undefined"></canvas>
                                    <script>
                                        new Chart(document.getElementById("chartjs-7"), {
                                            "type": "bar",
                                            "data": {
                                                "labels": ["January", "February", "March", "April"],
                                                "datasets": [{
                                                    "label": "Page Impressions",
                                                    "data": [10, 20, 30, 40],
                                                    "borderColor": "rgb(255, 99, 132)",
                                                    "backgroundColor": "rgba(255, 99, 132, 0.2)"
                                                }, {
                                                    "label": "Adsense Clicks",
                                                    "data": [5, 15, 10, 30],
                                                    "type": "line",
                                                    "fill": false,
                                                    "borderColor": "rgb(54, 162, 235)"
                                                }]
                                            },
                                            "options": {
                                                "scales": {
                                                    "yAxes": [{
                                                        "ticks": {
                                                            "beginAtZero": true
                                                        }
                                                    }]
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                            <!--/Graph Card-->
                        </div>

                        <div class="w-full p-6 md:w-1/2 xl:w-1/3">
                            <!--Graph Card-->
                            <div class="bg-white border-transparent rounded-lg shadow-xl">
                                <div class="p-2 text-gray-800 uppercase border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg bg-gradient-to-b from-gray-300 to-gray-100">
                                    <h5 class="font-bold text-gray-600 uppercase">Graph</h5>
                                </div>
                                <div class="p-5">
                                    <canvas id="chartjs-0" class="chartjs" width="undefined" height="undefined"></canvas>
                                    <script>
                                        new Chart(document.getElementById("chartjs-0"), {
                                            "type": "line",
                                            "data": {
                                                "labels": ["January", "February", "March", "April", "May", "June", "July"],
                                                "datasets": [{
                                                    "label": "Views",
                                                    "data": [65, 59, 80, 81, 56, 55, 40],
                                                    "fill": false,
                                                    "borderColor": "rgb(75, 192, 192)",
                                                    "lineTension": 0.1
                                                }]
                                            },
                                            "options": {}
                                        });
                                    </script>
                                </div>
                            </div>
                            <!--/Graph Card-->
                        </div>

                        <div class="w-full p-6 md:w-1/2 xl:w-1/3">
                            <!--Graph Card-->
                            <div class="bg-white border-transparent rounded-lg shadow-xl">
                                <div class="p-2 text-gray-800 uppercase border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg bg-gradient-to-b from-gray-300 to-gray-100">
                                    <h5 class="font-bold text-gray-600 uppercase">Graph</h5>
                                </div>
                                <div class="p-5">
                                    <canvas id="chartjs-1" class="chartjs" width="undefined" height="undefined"></canvas>
                                    <script>
                                        new Chart(document.getElementById("chartjs-1"), {
                                            "type": "bar",
                                            "data": {
                                                "labels": ["January", "February", "March", "April", "May", "June", "July"],
                                                "datasets": [{
                                                    "label": "Likes",
                                                    "data": [65, 59, 80, 81, 56, 55, 40],
                                                    "fill": false,
                                                    "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"],
                                                    "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"],
                                                    "borderWidth": 1
                                                }]
                                            },
                                            "options": {
                                                "scales": {
                                                    "yAxes": [{
                                                        "ticks": {
                                                            "beginAtZero": true
                                                        }
                                                    }]
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                            <!--/Graph Card-->
                        </div>

                        <div class="w-full p-6 md:w-1/2 xl:w-1/3">
                            <!--Graph Card-->
                            <div class="bg-white border-transparent rounded-lg shadow-xl">
                                <div class="p-2 text-gray-800 uppercase border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg bg-gradient-to-b from-gray-300 to-gray-100">
                                    <h5 class="font-bold text-gray-600 uppercase">Graph</h5>
                                </div>
                                <div class="p-5"><canvas id="chartjs-4" class="chartjs" width="undefined" height="undefined"></canvas>
                                    <script>
                                        new Chart(document.getElementById("chartjs-4"), {
                                            "type": "doughnut",
                                            "data": {
                                                "labels": ["P1", "P2", "P3"],
                                                "datasets": [{
                                                    "label": "Issues",
                                                    "data": [300, 50, 100],
                                                    "backgroundColor": ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "rgb(255, 205, 86)"]
                                                }]
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                            <!--/Graph Card-->
                        </div>

                        <div class="w-full p-6 md:w-1/2 xl:w-1/3">
                            <!--Table Card-->
                            <div class="bg-white border-transparent rounded-lg shadow-xl">
                                <div class="p-2 text-gray-800 uppercase border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg bg-gradient-to-b from-gray-300 to-gray-100">
                                    <h5 class="font-bold text-gray-600 uppercase">Graph</h5>
                                </div>
                                <div class="p-5">
                                    <table class="w-full p-5 text-gray-700">
                                        <thead>
                                            <tr>
                                                <th class="text-left text-blue-900">Name</th>
                                                <th class="text-left text-blue-900">Side</th>
                                                <th class="text-left text-blue-900">Role</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>Obi Wan Kenobi</td>
                                                <td>Light</td>
                                                <td>Jedi</td>
                                            </tr>
                                            <tr>
                                                <td>Greedo</td>
                                                <td>South</td>
                                                <td>Scumbag</td>
                                            </tr>
                                            <tr>
                                                <td>Darth Vader</td>
                                                <td>Dark</td>
                                                <td>Sith</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <p class="py-2"><a href="#">See More issues...</a></p>

                                </div>
                            </div>
                            <!--/table Card-->
                        </div>

                        <div class="w-full p-6 md:w-1/2 xl:w-1/3">
                            <!--Advert Card-->
                            <div class="bg-white border-transparent rounded-lg shadow-xl">
                                <div class="p-2 text-gray-800 uppercase border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg bg-gradient-to-b from-gray-300 to-gray-100">
                                    <h5 class="font-bold text-gray-600 uppercase">Advert</h5>
                                </div>
                                <div class="p-5 text-center">


                                    <script async type="text/javascript" src="//cdn.carbonads.com/carbon.js?serve=CK7D52JJ&placement=wwwtailwindtoolboxcom" id="_carbonads_js"></script>


                                </div>
                            </div>
                            <!--/Advert Card-->
                        </div>


                    </div>
                </div>

            </div>




            <script>
                /*Toggle dropdown list*/
                function toggleDD(myDropMenu) {
                    document.getElementById(myDropMenu).classList.toggle("invisible");
                }
                /*Filter dropdown options*/
                function filterDD(myDropMenu, myDropMenuSearch) {
                    var input, filter, ul, li, a, i;
                    input = document.getElementById(myDropMenuSearch);
                    filter = input.value.toUpperCase();
                    div = document.getElementById(myDropMenu);
                    a = div.getElementsByTagName("a");
                    for (i = 0; i < a.length; i++) {
                        if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                            a[i].style.display = "";
                        } else {
                            a[i].style.display = "none";
                        }
                    }
                }
                // Close the dropdown menu if the user clicks outside of it
                window.onclick = function(event) {
                    if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
                        var dropdowns = document.getElementsByClassName("dropdownlist");
                        for (var i = 0; i < dropdowns.length; i++) {
                            var openDropdown = dropdowns[i];
                            if (!openDropdown.classList.contains('invisible')) {
                                openDropdown.classList.add('invisible');
                            }
                        }
                    }
                }
            </script>

        @livewireScripts


            <!-- Page Heading -->
            {{-- <header class="bg-white shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header> --}}

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
