<x-theme.default>

    <x-slot:title>
        {{ __('site.Category Details') }}
    </x-slot>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        {{ __('site.Category Details') }}
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>{{ __('site.Name') }}</th>
                                <td>{{ $category->name }}</td>
                            </tr>

                            <tr>
                                <th>{{ __('site.Description') }}</th>
                                <td>{{ $category->description }}</td>
                            </tr>



                        </table>
                        <a class="btn btn-outline-primary btn-sm d-inline-block"
                            href="{{ route('category.edit', $category) }}"><i class='bx bxs-edit'>
                                {{ __('site.Edit') }}</i></a>
                        <form id="delete-form-{{ $category->id }}" class="d-inline-block"
                            action="{{ route('category.destroy', $category) }}" method="POST">
                            @method('DELETE')
                            @csrf

                            <button class="btn btn-outline-danger btn-sm" type="button"
                                onclick="confirm_delete('{{ $category->id }}')"><i class='bx bxs-trash'>
                                    {{ __('site.Delete') }}</i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <x-slot:script>
        <script>
            function confirm_delete(category) {

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
                        document.getElementById('delete-form-' + category).submit()
                    };
                });
            }
        </script>
    </x-slot>
</x-theme.default>
