<x-main-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        {{ __('site.Cart') }}
                    </div>
                    <div class="card-body" id="cart_card">

                        {{-- <h2 class="border-top mt-2 pt-2">{{ __('site.Cart') }}</h2> --}}
                        @if ($books->count() > 0)
                            <table class="table" id="inCartTable">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('site.Book Title') }}</th>
                                        <th scope="col">{{ __('site.Number Of Copies') }}</th>
                                        <th scope="col">{{ __('site.Item Price') }}</th>
                                        <th scope="col">{{ __('Site.Total Price') }}</th>
                                        <th scope="Col"></th>
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
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button
                                                        class="btn btn-danger d-inline-block d-inline-block text-truncate remove_one"
                                                        data-id="{{ $book->id }}">{{ __('site.Remove one') }}</button>
                                                    <button class="btn btn-danger delete"
                                                        data-id="{{ $book->id }}">{{ __('site.Delete') }}</button>
                                                </div>

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
                            <form action="{{ route('checkout') }}" method="POST">
                                @csrf
                                <button class="btn btn-primary" type="submit"> {{ __('site.Checkout') }}</button>
                            </form>
                        @else
                            <h3>{{ __('site.There are no books in Cart') }}</h3>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        removeOneButtons = document.getElementsByClassName('remove_one');
        deleteButtons = document.getElementsByClassName('delete');
        for (let i = 0; i < removeOneButtons.length; i++) {
            const book_id = removeOneButtons[i].dataset.id;
            const row = removeOneButtons[i].closest('tr');
            removeOneButtons[i].addEventListener('click', async () => {
                const response = await fetch("{{ route('cart.removeOne') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        _token: "{{ csrf_token() }}",
                        id: book_id
                    })
                })
                const data = await response.json();
                if (data.quantity > 1) {
                    row.querySelector('.number_of_copies').textContent = data.quantity;
                    row.querySelector('.items_price').textContent = data.total_price;
                    document.querySelector('#books_on_cart_price').textContent = data.books_on_cart_price;
                } else {
                    row.remove();
                    document.querySelector('#books_on_cart_price').textContent = data.books_on_cart_price;
                    document.getElementById('items_in_cart').textContent = data.books;
                    if (data.books < 1) {
                        document.getElementById('inCartTable').remove();
                        document.getElementById('cart_card').innerHTML =
                            '<h3>{{ __('site.There are no books in Cart') }}</h3>'
                    }
                }


            })


        }
        for (let i = 0; i < deleteButtons.length; i++) {
            const book_id = deleteButtons[i].dataset.id;
            const row = deleteButtons[i].closest('tr');
            deleteButtons[i].addEventListener('click', async () => {
                const response = await fetch("{{ route('cart.delete') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        _token: "{{ csrf_token() }}",
                        id: book_id
                    })
                })
                const data = await response.json();
                row.remove();
                document.querySelector('#books_on_cart_price').textContent = data.books_on_cart_price;
                document.getElementById('items_in_cart').textContent = data.books;
                if (data.books < 1) {
                    document.getElementById('inCartTable').remove();
                    document.getElementById('cart_card').innerHTML =
                        '<h3>{{ __('site.There are no books in Cart') }}</h3>'
                }
            })


        }
    </script>
</x-main-layout>
