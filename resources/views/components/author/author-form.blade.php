<x-theme.default>
    <x-slot:name>
        {{ isset($author) ? __('site.Author Edit') : __('site.Add Author') }}
    </x-slot>
    <div class="row justify-content-center col-md-7">
        <div class="card">
            <div class="card-header">
                {{ isset($author) ? __('site.Author Edit') : __('site.Add Author') }}
            </div>
            <div class="card-body">
                <form class="container-fluid" method="POST"
                    action="{{ isset($author) ? route('author.update', $author->id) : route('author.store') }}"
                    enctype="multipart/form-data">

                    @isset($author)
                        @method('PATCH')
                    @endisset
                    @csrf
                    <div class="row gy-2">
                        <div class="col-md-2"><label class="form-label">{{ __('site.Name') }}</label></div>
                        <div class="col-md-10"><input type="text"
                                class="form-control  @error('name')
                        is-invalid
                        @enderror"
                                name="name" value="{{ isset($author) ? $author->name : old('name') }}">
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
                                name="description" rows="3">{{ isset($author) ? $author->description : old('description') }}</textarea>
                            @error('description')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                       
                        <div class=" col-md-2">
                            <input class="btn btn-primary" type="submit"
                                value="{{ isset($author) ? __('site.Update') : __('site.Create') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    
</x-theme.default>
