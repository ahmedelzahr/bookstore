<x-theme.default>

    <x-slot:title>
        {{ __('site.Publishers') }}
    </x-slot>
    <div class="row justify-content-center">
        <div class="container ">
            <a href="{{ route('publisher.create') }}" type="button " class="btn btn-primary btn-sm col-md-2 mb-2 display">+
                {{ __('site.Add Publisher') }}</a>
            <table class="table table-striped display nowrap" id="publishers-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">{{ __('site.Name') }}</th>
                        <th scope="col">{{ __('site.Address') }}</th>
                        <th scope="col">{{ __('site.Options') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($publishers as $publisher)
                        <tr>
                            <td><a href="{{ route('publisher.show', $publisher) }}">{{ $publisher->name }}</a>
                            </td>
                            <td>{{ $publisher->address }}</td>
                            <td><a class="btn btn-outline-primary btn-sm d-inline-block"
                                    href="{{ route('publisher.edit', $publisher) }}"><i class='bx bxs-edit'>
                                        {{ __('site.Edit') }}</i></a>
                                <form id="delete-form-{{ $publisher->id }}" class="d-inline-block"
                                    action="{{ route('publisher.destroy', $publisher) }}" method="POST">
                                    @method('DELETE')
                                    @csrf

                                    <button class="btn btn-outline-danger btn-sm" type="button"
                                        onclick="confirm_delete('{{ $publisher->id }}')"><i class='bx bxs-trash'>
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
            function confirm_delete(publisher) {
          
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
                            document.getElementById('delete-form-'+publisher).submit()
                        };
                    });
            }
            var table = new DataTable('#publishers-table', {
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
            //     $('#publishers-table').dataTable({
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
