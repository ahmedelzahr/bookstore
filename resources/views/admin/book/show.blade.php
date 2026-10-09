<x-theme.default>

     <x-slot:title>
          {{ __('site.Book Details') }}
    </x-slot>
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        {{ __('site.Book Details') }}
                    </div>
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
                                <td><a href="#">{{ $book->category->name??'' }}</a></td>
                            </tr>
                            <tr>
                                <th class="d-flex gap-1">{{ __('site.Authors') }}</th>
                                <td>
                                    @foreach ($book->authors as $author)
                                        <a href="#">{{ $author->name }}</a>
                                    @endforeach
                                <td>
                            </tr>
                            <tr>
                                <th>{{ __('site.Description') }}</th>
                                <td>{{ $book->description }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('site.Number Of Pages') }}</th>
                                <td>{{ $book->number_of_pages}}</td>
                            </tr>
                            <tr>
                                <th>{{ __('site.Number Of Copies') }}</th>
                                <td>{{ $book->number_of_copies }}</td>
                            </tr>
                               <tr>
                                <th>{{ __('site.Price') }}</th>
                                <td>{{ $book->price }} $</td>
                            
                        </table>
                        <a class="btn btn-outline-primary btn-sm d-inline-block"
                                    href="{{ route('book.edit', $book) }}"><i class='bx bxs-edit'>
                                        {{ __('site.Edit') }}</i></a>
                                <form id="delete-form-{{ $book->id }}" class="d-inline-block"
                                    action="{{ route('book.destroy', $book) }}" method="POST">
                                    @method('DELETE')
                                    @csrf

                                    <button class="btn btn-outline-danger btn-sm" type="button"
                                        onclick="confirm_delete('{{ $book->id }}')"><i class='bx bxs-trash'>
                                            {{ __('site.Delete') }}</i></button>
                    </div>
                </div>
            </div>
        </div>

    </div>
     <x-slot:script>
        <script>
            function confirm_delete(book) {

                Swal.fire({
                    title: "{{ __('site.Are you sure?') }}",
                    text: "{{ __("site.You won't be able to revert this!") }}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "{{ __('site.Cancel') }}",
                    confirmButtonText: "{{ __('site.Yes, delete it!') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + book).submit()
                    };
                });
            }
        </script>
    </x-slot>
</x-theme.default>