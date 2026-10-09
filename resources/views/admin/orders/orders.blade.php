<x-theme.default>

    <x-slot:title>
        {{ __('site.Orders') }}
    </x-slot>
    <div class="row justify-content-center">
        <div class="container ">
           
            <table class="table table-striped display nowrap" id="orders-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">{{ __('site.title') }}</th>
                        <th scope="col">{{ __('site.Number Of Copies') }}</th>
                        <th scope="col">{{ __('site.Price') }}</th>
                        <th scope="col">{{ __('site.Total Price') }}</th>
                        <th scope="col">{{ __('site.Order Date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            {{-- <td><a href="{{ route('category.show', $category) }}">{{ $category->name }}</a>
                            </td> --}}
                            <td>{{ $product->book->title }}</td>
                           <td>{{ $product->number_of_copies }}</td>
                           <td>{{ $product->price }}</td>
                           <td>{{ $product->number_of_copies*$product->price }}</td>
                           <td>{{ $product->created_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

   <x-slot:script>
        <script>
           
            var table = new DataTable('#orders-table', {
                autoWidth: false,
                columnDefs: [{
                    targets: [0, 1, 2, 3, 4], // Index of columns to align (0-based)
                    className: 'dt-left'
                }],

                scrollX: true,
                @if (app()->getLocale() == 'ar')
                    columnDefs: [{
                        targets: [0, 1, 2, 3, 4], // Index of columns to align (0-based)
                        className: 'dt-right'
                    }],
                    "language": {
                        url: 'https:///cdn.datatables.net/plug-ins/2.3.7/i18n/ar.json',
                    },
                @endif

            });


          
        </script>
    </x-slot>
</x-theme.default>
