<x-theme.default>

    <x-slot:title>
        {{ __('site.Author Details') }}
    </x-slot>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        {{ __('site.Author Details') }}
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>{{ __('site.Name') }}</th>
                                <td>{{ $author->name }}</td>
                            </tr>

                            <tr>
                                <th>{{ __('site.Description') }}</th>
                                <td>{{ $author->description }}</td>
                            </tr>



                        </table>
                        <a class="btn btn-outline-primary btn-sm d-inline-block"
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
                    </div>
                </div>
            </div>
        </div>

    </div>
    <x-slot:script>
        <script>
            function confirm_delete(author) {

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
                        document.getElementById('delete-form-' + author).submit()
                    };
                });
            }
        </script>
    </x-slot>
</x-theme.default>
