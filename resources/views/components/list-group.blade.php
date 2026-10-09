<x-main-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        {{ $cardHeader}}
                    </div>
                    <div class="card-body">
                        <form action="{{ $searchRoute }}" method="GET">
                            <div class="row d-flex justify-content-center gx-3">
                                @csrf
                                <div class="col-9 col-lg-7">
                                    <input class="form-control" type="search" placeholder="{{ __('site.Search') }}"
                                        name="keyword" />
                                </div>
                                <div class="col-3 col-lg-2 ">
                                    <button class="btn btn-secondary bg-secondary w-100"
                                        type="submit">{{ __('site.Search') }}</button>
                                </div>

                            </div>

                        </form>                     
                        <h2 class="border-top mt-2 pt-2">{{ $title }}</h2>
                       @if ($items->count()>0)
                            <ul class="list-group">
                            @foreach ($items as $item)
                                <a class="text-muted" href="{{ route( $routeName , $item) }}">
                                    <li class="list-group-item">
                                        {{ $item->name }} {{ $item->books()->count() }}
                                    </li>
                                </a> </td>
                            @endforeach
                              
                        </ul>
                       @else
                           <h3>{{ $emptyStatement }}</h3>
                       @endif
                       
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-main-layout>
