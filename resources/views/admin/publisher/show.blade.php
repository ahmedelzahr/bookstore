<x-theme.default>

    <x-slot:title>
        {{ __('site.Publisher Details') }}
    </x-slot>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        {{ __('site.Publisher Details') }}
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>{{ __('site.Name') }}</th>
                                <td>{{ $publisher->name }}</td>
                            </tr>

                            <tr>
                                <th>{{ __('site.Address') }}</th>
                                <td>{{ $publisher->address }}</td>
                            </tr>



                        </table>
                        <a class="btn btn-outline-primary btn-sm d-inline-block"
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
                    </div>
                </div>
            </div>
        </div>

    </div>
    <x-slot:script>
        <script>
            function confirm_delete(publisher) {

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
                        document.getElementById('delete-form-' + publisher).submit()
                    };
                });
            }
        </script>
    </x-slot>
</x-theme.default>
