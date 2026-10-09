<x-theme.default>

    <x-slot:title>
        {{ __('site.Authors') }}
    </x-slot>
    <div class="row justify-content-center">
        <div class="container ">
            <a href="{{ route('author.create') }}" type="button " class="btn btn-primary btn-sm col-md-2 mb-2 display">+
                {{ __('site.Add Author') }}</a>
            <table class="table table-striped display nowrap" id="authors-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">{{ __('site.Name') }}</th>
                        <th scope="col">{{ __('site.Description') }}</th>
                        <th scope="col">{{ __('site.Options') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $author)
                        <tr>
                            <td><a href="{{ route('author.show', $author) }}">{{ $author->name }}</a>
                            </td>
                            <td>{{ $author->description }}</td>
                            <td><a class="btn btn-outline-primary btn-sm d-inline-block"
                                    href="{{ route('author.edit', $author) }}"><i class='bx bxs-edit'>
                                        {{ __('site.Edit') }}</i></a>
                                <form id="delete-form-{{ $author->id }}" class="d-inline-block"
                                    action="{{ route('author.destroy', $author) }}" method="POST">
                                    @method('DELETE')
                                    @csrf

                                    <button class="btn btn-outline-danger btn-sm" type="button"
                                        onclick="confirm_delete('{{ $author->id }}')"><i class='bx bxs-trash'>
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
            function confirm_delete(author) {
          
                    Swal.fire({
                        title:"{{ __("site.Are you sure?") }}",
                        text: "{{ __("site.You won't be able to revert this!") }}",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        cancelButtonText: "{{ __('site.Cancel') }}",
                        confirmButtonText:"{{ __('site.Yes, delete it!') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-'+author).submit()
                        };
                    });
            }
            var table = new DataTable('#authors-table', {
                autoWidth: false,
                columnDefs: [{
                    targets: [0, 1, 2], // Index of columns to align (0-based)
                    className: 'dt-left'
                }],

                scrollX: true,
                @if (app()->getLocale() == 'ar')
                    columnDefs: [{
                        targets: [0, 1, 2], // Index of columns to align (0-based)
                        className: 'dt-right'
                    }],
                    "language": {
                        url: 'https:///cdn.datatables.net/plug-ins/2.3.7/i18n/ar.json',
                    },
                @endif

            });


            // $(document).ready(function() {
            //     $('#authors-table').dataTable({
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
