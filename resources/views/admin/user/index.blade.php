<x-theme.default>

    <x-slot:title>
        {{ __('site.Users') }}
    </x-slot>
    <div class="row justify-content-center">
        <div class="container ">
            
            <table class="table table-striped display nowrap" id="users-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">{{ __('site.Name') }}</th>
                        <th scope="col">{{ __('site.Email') }}</th>
                        <th scope="col">{{ __('site.User Type') }}</th>
                        <th scope="col">{{ __('site.Options') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td><a href="{{ route('user.show', $user) }}">{{ $user->name }}</a>
                            </td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->isSuperAdmin()?__('site.General Maneger'):($user->isAdmin()?__('site.Maneger'):__('site.User'))}}</td>
                            <td>
                                <form action="{{ route('user.update',$user) }}" class="d-inline-block" id="edit_form-{{ $user->id }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <select name="adminstration_level" class="form-select" onchange="confirm_edit('{{ $user->id }}')">
                                        <option disabled selected>{{ __('site.Choose Level') }}</option>
                                        <option value=0>{{ __('site.User') }}</option>
                                        <option value=1>{{ __('site.Maneger') }}</option>
                                        <option value=2>{{ __('site.General Maneger') }}</option>
                                    </select>
                                </form>
                                
                                <form id="delete-form-{{ $user->id }}" class="d-inline-block"
                                    action="{{ route('user.destroy', $user) }}" method="POST">
                                    @method('DELETE')
                                    @csrf

                                    <button class="btn btn-outline-danger btn-sm {{ $user->id==auth()->user()->id?'disabled':'' }}" type="button"
                                        onclick="confirm_delete('{{ $user->id }}')"><i class='bx bxs-trash'>
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
            function confirm_delete(user) {
          
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
                            document.getElementById('delete-form-'+user).submit()
                        };
                    });
            }
             function confirm_edit(user) {
          
                    Swal.fire({
                        title:"{{ __("site.Are you sure?") }}",
                        text: "{{ __("site.You won't be able to revert this!") }}",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        cancelButtonText: "{{ __('site.Cancel') }}",
                        confirmButtonText:"{{ __('site.Yes, Save!') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('edit_form-'+user).submit()
                        };
                    });
            }
            var table = new DataTable('#users-table', {
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
            //     $('#users-table').dataTable({
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
