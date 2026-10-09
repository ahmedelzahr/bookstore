<x-main-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        {{ __('site.Book Details') }}
                    </div>
                    @auth
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <div class="row  g-3 align-items-center justify-content-center form">

                                <div class="col-auto">
                                    <input type="number" class="form-control" id="quantity" value="1" name="quantity"
                                        min="0" max="{{ $book->number_of_copies }}">
                                </div>
                                <button class="col-auto btn btn-outline-primary" id="add_to_cart">
                                    <i class='bx bxs-cart'></i>
                                    {{ __('site.Add to Cart') }}
                                </button>
                            </div>
                        </div>
                    @endauth

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>{{ __('site.title') }}</th>
                                <td>{{ $book->title }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('site.Book Cover') }}</th>
                                <td><img class= "img-thumbnail" src="{{ asset('storage/' . $book->cover_image) }}"
                                        alt=""></td>
                            </tr>
                            <tr>
                                <th>{{ __('site.Category') }}</th>
                                <td><a href="#">{{ $book->category->name ?? '' }}</a></td>
                            </tr>
                            <tr>
                                <th class="d-flex gap-1">{{ __('site.Authors') }}</th>
                                <td>
                                    @foreach ($book->authors as $author)
                                        <a href="#">{{ $author->name ?? '' }}</a>
                                    @endforeach
                                <td>
                            </tr>
                            <tr>
                                <th>{{ __('site.Description') }}</th>
                                <td>{{ $book->description }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('site.Number Of Pages') }}</th>
                                <td>{{ $book->number_of_pages }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('site.Number Of Copies') }}</th>
                                <td>{{ $book->number_of_copies }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('site.Price') }}</th>
                                <td>{{ $book->price }} $</td>
                            </tr>
                            <tr>
                                <th>{{ __('site.Book Rate') }}</th>
                                <td>
                                    <div class="rate_dive position-relative  d-flex">
                                        <div class="filled_rate position-absolute overflow-hidden d-flex justify-between"
                                            id="{{ 'filled_rate_' . $book->id }}"
                                            style="width: {{ $book->rate() * 20 }}%; color:#FFDC01">
                                            <div class="d-flex w-100">
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                            </div>
                                        </div>

                                        <div class="d-flex" style="color:gray ">
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                        </div>

                                    </div>
                                    <span>{{ $book->ratings()->count() . __('site.Users') }}</span>
                                </td>
                            </tr>

                        </table>
                        <h2>{{ __('site.Rate This Book') }}</h2>
                        @auth

                        @if (auth()->user()->isPurchased($book->id))
                             <div
                                class="rating_wrapper {{ app()->getLocale() == 'ar' ? 'rating_wrapper_right' : 'rating_wrapper_left' }}">
                                @if (auth()->user()->rated($book))
                                    <span class="star {{ auth()->user()->bookRating($book) >= 1 ? 'active' : '' }}"
                                        data-value=1></span>
                                    <span class="star {{ auth()->user()->bookRating($book) >= 2 ? 'active' : '' }}"
                                        data-value=2></span>
                                    <span class="star {{ auth()->user()->bookRating($book) >= 3 ? 'active' : '' }}"
                                        data-value=3></span>
                                    <span class="star {{ auth()->user()->bookRating($book) >= 4 ? 'active' : '' }}"
                                        data-value=4></span>
                                    <span class="star {{ auth()->user()->bookRating($book) >= 5 ? 'active' : '' }}"
                                        data-value=5></span>
                                @else
                                    <span class="star" data-value=1></span>
                                    <span class="star" data-value=2></span>
                                    <span class="star" data-value=3></span>
                                    <span class="star" data-value=4></span>
                                    <span class="star" data-value=5></span>
                                @endif
                            </div>
                            @else
                            <p>{{ __('site.Purchase The Book first to rate the book') }}</p>
                        @endif
                           

                        @endauth
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        const stars = document.getElementsByClassName('star');
        for (let i = 0; i < stars.length; i++) {

            stars[i].addEventListener("click", async () => {
                const formData = new FormData();
                formData.append("value", stars[i].getAttribute("data-value"));
                formData.append("_token", "{{ csrf_token() }}");
                try {
                    const response = await fetch("/{{ $book->id }}/rating/rate", {
                        method: "POST",
                        body: formData,
                    });
                    if (!response.ok) {
                        throw new Error(`Response status: ${response.status}`);
                    }
                    alert('تمت عملية التقييم بنجاح');
                    location.reload();
                    // for (let j=i;j>=0;j--){
                    //     stars[j].classList.add('active');
                    // }
                    //   for (let j=(i+1);j<stars.length;j++){
                    //     stars[j].classList.remove('active');
                    // }

                } catch (error) {
                    console.log(error.message);
                }
            });

        };

        buttom_cart = document.getElementById('add_to_cart');
        buttom_cart.addEventListener('click', async () => {
            const cart_form = new FormData();
            qunatity = document.getElementById('quantity').value;
            cart_form.append("quantity", qunatity);
            cart_form.append("id", {{ $book->id }});
            cart_form.append("_token", "{{ csrf_token() }}");
            try {
                const response = await fetch("{{ route('cart.add') }}", {
                    method: "POST",
                    body: cart_form,
                });
                const $data = await response.json();
                if (!response.ok) {
                    throw new Error(`Response status: ${response.status}`);
                }
                document.getElementById('items_in_cart').textContent = $data.number_of_book;
                const toaster = new ToasterUi();
                const options = {
                    duration: 2000,
                    styles: {
                        backgroundColor: 'Gree',
                        color: '#ffffff',
                        border: '1px solid #ffffff',
                    },
                };

                toaster.addToast("{{ __('site.Added To Cart') }}", "success", options);


            } catch (error) {
                console.log(error.message);
            }
        });
    </script>
</x-main-layout>
