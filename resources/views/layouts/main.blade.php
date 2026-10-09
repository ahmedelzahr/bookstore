<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : '' }}">

<head>
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <meta charset="utf-8" />
    <title>Accept a payment</title>
 
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Noto+Kufi+Arabic:wght@100..900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: "Cairo", sans-serif;
            background-color: #f0f0f0;
        }

        .rate_dive {
            width: fit-content;
        }

        .active {
            color: yellow;
        }

        .rating_wrapper {
            display: inline-block;


        }

        .rating_wrapper_right {

            direction: rtl;
            text-decoration: right;

        }

        .rating_wrapper_left {

            direction: ltr;
            text-decoration: left;

        }

        .rating_wrapper span {
            display: block;
            margin-inline: 2px;

        }

        .rating_wrapper_right span {

            float: right;
        }

        .rating_wrapper_left span {

            float: left;
        }

        .rating_wrapper>span::after {

            font-family: 'boxicons' !important;
            content: "\eeb8";
        }

        .star {
            cursor: pointer;
        }

        .rating_wrapper:hover .star::after {
            color: yellow;
        }

        .rating_wrapper .star:hover~::after {
            color: gray;
        }



        /* .rating_wrapper>span:hover::after{
            cursor: pointer;
            
        } */
    </style>
    <title>Bookstore</title>
    {{ $head ?? '' }}
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white py-0">
        <div class="container-fluid">
            <a href="{{ route('dashboard') }}" class="navbar-brand">{{ __('site.Hasoub Library') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav order-lg-2">
                    @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">{{ __('site.Log in') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">{{ __('site.Register') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link " data-bs-toggle="dropdown" href="#" role="button"
                                aria-expanded="false"><img class="rounded-circle object-fit-cover"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" /></a>
                            <ul class="dropdown-menu">
                                @can('update-books')
                                    <li> <a class="dropdown-item" href="{{ route('admin') }}">
                                            {{ __('site.Dashboard') }}</a></li>

                                    <li>
                                    @endcan
                                <li> <a class="dropdown-item" href="{{ route('profile.show') }}">
                                        {{ __('site.Profile') }}</a></li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            {{ __('site.Log Out') }}
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </li>

                    @endguest

                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                    @auth
                        <li class="nav-item ">
                            <a href={{ route('orders') }} class="nav-link d-flex align-items-center">
                               <i class='bx bx-cart-alt'></i>
                                    {{ __('site.My Orders') }} </a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a href={{ route('ctegories_list') }} class="nav-link"><i
                                class='bx bx-list-ul'></i>{{ __('site.Catgories') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href={{ route('publishers_list') }} class="nav-link"><i class='bx bx-grid'></i>
                            {{ __('site.Publishers') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href={{ route('authors_list') }} class="nav-link"><i
                                class='bx bx-pen'></i>{{ __('site.Authors') }}</a>
                    </li>
                    @auth
                        <li class="nav-item ">
                            <a href={{ route('cart.index') }} class="nav-link d-flex align-items-center">
                                <div id="items_in_cart" class="rounded-2 px-2 bg-body-secondary"> {{ auth()->user()->booksOnCart()->count() }}</div> <i
                                    class='bx bxs-cart'></i>
                                    {{ __('site.Cart') }} </a>
                        </li>
                    @endauth

                </ul>

            </div>
        </div>
    </nav>
    <main class="py-4">
        {{ $slot }}
    </main>
<script src="https://cdn.jsdelivr.net/npm/toaster-ui@1.1.5/dist/main.js">

</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    {{ $script ?? '' }}
</body>

</html>
