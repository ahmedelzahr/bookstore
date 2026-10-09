<x-main-layout>

    <section class="row  gap-2  p-4 justify-content-center"
        style="background-color: #eee; border-radius: .5rem .5rem 0 0;">
        <style>
            @media (max-width: 767.98px) {
                .border-sm-start-none {
                    border-left: none !important;
                }
            }
        </style>
        <p><span class="h2">{{ __('site.My Orders') }} </span></p>
        <div class="row col-12"><a href="/" class="btn btn-primary col-sm-2">{{ __('site.Buy new book') }}</a> </div>
        
        @forelse ($products as $product)
            {{-- <div class="row justify-content-center mb-3">
                <div class="col-md-12">
                    <div class="card shadow-0 border rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                    <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                        <img src="{{ $product->coverImageLink() }}" class="w-100">
                                        <a href="#!">
                                            <div class="hover-overlay">
                                                <div class="mask"
                                                    style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <h5>{{ $product->title }}</h5>
                                    <div class="d-flex flex-row align-items-center">
                                        <div class="rate_dive position-relative  d-flex">
                                            <div class="filled_rate position-absolute overflow-hidden d-flex justify-between"
                                                id="{{ 'filled_rate_' . $product->id }}"
                                                style="width: {{ $product->rate() * 20 }}%; color:#FFDC01">
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
                                        <span>{{ $product->ratings()->count() }}</span>
                                    </div>

                                    <p class="text-truncate mb-4 mb-md-0">
                                        {{__('site.Number Of Copies') .' '.$product->pivot->number_of_copies}}
                                    </p>
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                    <div class="d-flex flex-row align-items-center mb-1">
                                        <h4 class="mb-1 me-1">{{ $product->pivot->price }} $</h4>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

<div class="row col-12 justify-content-center">
 <div class="card mb-4 col-md-6">
                <div class="card-body p-4">
                    <div class="row align-items-center ">
                        <div class="col-md-2">
                            <img src="{{ $product->coverImageLink() }}" class="img-fluid" alt="Generic placeholder image">
                        </div>
                        <div class="col-md-2 d-flex justify-content-center">
                            <div>
                                <p class="small text-muted mb-4 pb-2">{{ __('site.Book Title') }}</p>
                                <p class="lead fw-normal mb-0">{{ $product->title }}</p>
                            </div>
                        </div>

                        <div class="col-md-2 d-flex justify-content-center">
                            <div>
                                <p class="small text-muted mb-4 pb-2">{{ __('site.Number Of Copies') }}</p>
                                <p class="lead fw-normal mb-0">{{ $product->pivot->number_of_copies }}</p>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex justify-content-center">
                            <div>
                                <p class="small text-muted mb-4 pb-2">{{ __('site.Price') }}</p>
                                <p class="lead fw-normal mb-0">{{ $product->price }}</p>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex justify-content-center">
                            <div>
                                <p class="small text-muted mb-4 pb-2">{{ __('site.Total') }}</p>
                                <p class="lead fw-normal mb-0">{{'$' .$product->number_of_copies*$product->price}}</p>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex justify-content-center">
                            <div>
                                <p class="small text-muted mb-4 pb-2">{{ __('site.Order Date') }}</p>
                                <p class="lead fw-normal mb-0">{{ $product->pivot->created_at }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
           


        @empty
        @endforelse


    </section>
</x-main-layout>
