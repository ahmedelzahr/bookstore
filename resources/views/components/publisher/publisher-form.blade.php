<x-theme.default>
    <x-slot:title>
        {{ isset($publisher) ? __('site.Publisher Edit') : __('site.Add Publisher') }}
    </x-slot>
    <div class="row justify-content-center col-md-7">
        <div class="card">
            <div class="card-header">
                {{ isset($publisher) ? __('site.Publisher Edit') : __('site.Add Publisher') }}
            </div>
            <div class="card-body">
                <form class="container-fluid" method="POST"
                    action="{{ isset($publisher) ? route('publisher.update', $publisher->id) : route('publisher.store') }}"
                    enctype="multipart/form-data">

                    @isset($publisher)
                        @method('PATCH')
                    @endisset
                    @csrf
                    <div class="row gy-2">
                        <div class="col-md-2"><label class="form-label">{{ __('site.Name') }}</label></div>
                        <div class="col-md-10"><input type="text"
                                class="form-control  @error('title')
                        is-invalid
                        @enderror"
                                name="name" value="{{ isset($publisher) ? $publisher->name : old('name') }}">
                            @error('title')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
          
                        <div class="col-md-2">
                            <label class="col-form-label">{{ __('site.Address') }}</label>
                        </div>
                        <div class="col-md-10 ">
                            <textarea
                                class="form-control @error('address')
                        is-invalid
                        @enderror"
                                name="address" rows="3">{{ isset($publisher) ? $publisher->address : old('address') }}</textarea>
                            @error('address')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                       
                        <div class=" col-md-2">
                            <input class="btn btn-primary" type="submit"
                                value="{{ isset($publisher) ? __('site.Update') : __('site.Create') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    
</x-theme.default>
