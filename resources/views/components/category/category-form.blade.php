<x-theme.default>
    <x-slot:title>
        {{ isset($category) ? __('site.Category Edit') : __('site.Add Category') }}
    </x-slot>
    <div class="row justify-content-center col-md-7">
        <div class="card">
            <div class="card-header">
                {{ isset($category) ? __('site.Category Edit') : __('site.Add Category') }}
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
                        <div class="col-md-2"><label class="form-label">{{ __('site.Name') }}</label></div>
                        <div class="col-md-10"><input type="text"
                                class="form-control  @error('title')
                        is-invalid
                        @enderror"
                                name="name" value="{{ isset($category) ? $category->name : old('name') }}">
                            @error('title')
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


    
</x-theme.default>
