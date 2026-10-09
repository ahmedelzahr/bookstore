<x-theme.default>

    <x-slot:title>
        {{ __('site.Books') }}
    </x-slot>
    <div class="row justify-content-center">
        <div class="container ">
            <a href="{{ route('book.create') }}" type="button " class="btn btn-primary btn-sm col-md-2 mb-2 display">+
                {{ __('site.Add Book') }}</a>
            <table class="table table-striped display nowrap" id="books-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">{{ __('site.title') }}</th>
                        <th scope="col">{{ __('site.ISBN') }}</th>
                        <th scope="col">{{ __('site.Category') }}</th>
                        <th scope="col">{{ __('site.Authors') }}</th>
                        <th scope="col">{{ __('site.Publisher') }}</th>
                        <th scope="col">{{ __('site.Price') }}</th>
                        <th scope="col">{{ __('site.Options') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td><a href="{{ route('book.show', $book) }}">{{ $book->title }}</a>
                            </td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->category->name??'' }}</td>
                            <td>
                                @foreach ($book->authors as $author)
                                    {{ $author->name }}
                                @endforeach
                            </td>
                            <td>{{ $book->publisher->name??'' }}</td>
                            <td>{{ $book->price }}</td>
                            <td><a class="btn btn-outline-primary btn-sm d-inline-block"
                                    href="{{ route('book.edit', $book) }}"><i class='bx bxs-edit'>
                                        {{ __('site.Edit') }}</i></a>
                                <form id="delete-form-{{ $book->id }}" class="d-inline-block"
                                    action="{{ route('book.destroy', $book) }}" method="POST">
                                    @method('DELETE')
                                    @csrf

                                    <button class="btn btn-outline-danger btn-sm" type="button"
                                        onclick="confirm_delete('{{ $book->id }}')"><i class='bx bxs-trash'>
                                            {{ __('site.Delete') }}</i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <x-slot:script>
        <script>
            function confirm_delete(book) {
          
                    Swal.fire({
                        title:"{{ __('site.Are you sure?') }}",
                        text: "{{ __("site.You won't be able to revert this!") }}",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        cancelButtonText: "{{ __('site.Cancel') }}",
                        confirmButtonText:"{{ __('site.Yes, delete it!') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-'+book).submit()
                        };
                    });
            }
            var table = new DataTable('#books-table', {
                autoWidth: false,
                columnDefs: [{
                    targets: [0, 1, 2, 3, 4, 5, 6], // Index of columns to align (0-based)
                    className: 'dt-left'
                }],

                scrollX: true,
                @if (app()->getLocale() == 'ar')
                    columnDefs: [{
                        targets: [0, 1, 2, 3, 4, 5, 6], // Index of columns to align (0-based)
                        className: 'dt-right'
                    }],
                    "language": {
                        url: 'https:///cdn.datatables.net/plug-ins/2.3.7/i18n/ar.json',
                    },
                @endif

            });


            // $(document).ready(function() {
            //     $('#books-table').dataTable({
            //         @if (app()->getLocale() == 'ar')
            //         "language": {
            //            url: '//cdn.datatables.net/plug-ins/2.3.7/i18n/ar.json',
            //         },
            //         @endif

            //     });
            // });
        </script>
    </x-slot>
</x-theme.default>
