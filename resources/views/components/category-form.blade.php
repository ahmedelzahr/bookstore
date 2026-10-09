<x-theme.default>
    <x-slot:name>
        {{ isset($category) ? __('site.category Edit') : __('site.Add category') }}
    </x-slot>
    <div class="row justify-content-center col-md-7">
        <div class="card">
            <div class="card-header">
                {{ isset($category) ? __('site.category Edit') : __('site.Add category') }}
            </div>
            <div class="card-body">
                <form class="container-fluid" method="POST"
                    action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}"
                    enctype="multipart/form-data">

                    @isset($category)
                        @method('PATCH')
                    @endisset
                    @csrf
                    <div class="row gy-2">
                        <div class="col-md-2"><label class="form-label">{{ __('site.name') }}</label></div>
                        <div class="col-md-10"><input type="text"
                                class="form-control  @error('name')
                        is-invalid
                        @enderror"
                                name="name" value="{{ isset($category) ? $category->name : old('name') }}">
                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                     
                        <div class="col-md-2">
                            <label class="col-form-label">{{ __('site.Description') }}</label>
                        </div>
                        <div class="col-md-10 ">
                            <textarea
                                class="form-control @error('description')
                        is-invalid
                        @enderror"
                                name="description" rows="3">{{ isset($category) ? $category->description : old('description') }}</textarea>
                            @error('description')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class=" col-md-2">
                            <input class="btn btn-primary" type="submit"
                                value="{{ isset($category) ? __('site.Update') : __('site.Create') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <x-slot:script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                new SlimSelect({
                    select: '#author_select',
                    settings: {
                        placeholderText: '{{ __('site.Choose Author..') }}',
                        hideSelected: true,
                    }
                });
            });


            const img_input = document.querySelector("input[type=file]");
            const img_cover = document.querySelector("#category-cover-img");
            img_input.addEventListener('change', img_preview);

            function img_preview() {
                const file = img_input.files[0];
                const file_reader = new FileReader();
                file_reader.addEventListener('load', () => {
                    img_cover.classList.remove('d-none');
                    img_cover.src = file_reader.result;
                });
                if (file) {
                    file_reader.readAsDataURL(file);
                }

            }
        </script>
    </x-slot:script>
</x-theme.default>
