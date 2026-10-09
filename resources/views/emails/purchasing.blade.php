<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : '' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-lg-6">
                <div class="card">
                    <div class="card-body" id="cart_card">
                        <table class="table" id="inCartTable">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('site.Book Title') }}</th>
                                    <th scope="col">{{ __('site.Number Of Copies') }}</th>
                                    <th scope="col">{{ __('site.Item Price') }}</th>
                                    <th scope="col">{{ __('Site.Total Price') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td>{{ $book->title }}</td>
                                        <td class="number_of_copies">{{ $book->pivot->number_of_copies }}</td>
                                        <td>{{ $book->price }} $</td>
                                        <td class="items_price">{{ $book->price * $book->pivot->number_of_copies }}
                                            $
                                        </td>



                                    </tr>
                                @endforeach
                                <tr>
                                    <td> {{ __('site.Total') }} </td>
                                    <td></td>
                                    <td></td>
                                    <td id="books_on_cart_price">
                                        {{ $total }} $
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
