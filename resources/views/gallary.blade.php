<x-main-layout>
    <div class="container">

        <form action="{{ route('book.search') }}" method="GET">
            <div class="row d-flex justify-content-center gx-3">
                @csrf
                <div class="col-9 col-sm-6 col-lg-4">
                    <input class="form-control" type="search" placeholder="{{ __('site.Search') }}" name="keyword" />
                </div>
                <div class="col-3 col-sm-2 col-lg-1">
                    <button class="btn btn-secondary bg-secondary w-100" type="submit">{{ __('site.Search') }}</button>
                </div>

            </div>

        </form>
        <h2 class=" col-3">{{ $title ?? '' }}</h2>
        <div class="row g-3">
            @forelse ($books as $book)
                @if ($book->number_of_copies > 0)
                    <div class="col-6 col-md-4 col-lg-3 ">
                        <div class="card">
                            <a href="{{ route('book.details', $book) }}"> <img
                                    src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top"
                                    alt="..."></a>
                            <div class="card-body">
                                <a href="{{ route('book.details', $book) }}"
                                    class=" d-block pb-2 ">{{ $book->title }}</a>
                                {{-- @isset($book->category)
                                    <a href="{{ route('catgory.books', $book->category) }}" class=" d-block link-secondary">{{ $book->category->name }}</a>
                                @endisset --}}

                                <div class="d-flex justify-content-between">
                                    <p>
                                        {{ $book->price }}
                                        <span>$ </span>
                                    </p>
                                    <div class="rate_dive position-relative">
                                        <div class="filled_rate position-absolute overflow-hidden" id="{{ 'filled_rate_' . $book->id }}" style="width: {{$book->rate()*20 }}%; color:#FFDC01">
                                            <div class="d-flex">
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="d-flex" style="color:gray">
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
            @endforelse
        </div>
        {{ $books->links() }}
    </div>
  {{-- <script>
    @foreach ($books as $book)
        document.getElementById("filled_rate_{{ $book->id }}").style.width = "{{ $book->rate() }}%";
    @endforeach
</script> --}}
</x-main-layout>
