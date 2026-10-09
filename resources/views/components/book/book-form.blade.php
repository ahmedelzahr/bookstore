<x-theme.default>
    <x-slot:title>
        {{ isset($book) ? __('site.Book Edit') : __('site.Add Book') }}
    </x-slot>
    <div class="row justify-content-center col-md-7">
        <div class="card">
            <div class="card-header">
                {{ isset($book) ? __('site.Book Edit') : __('site.Add Book') }}
            </div>
            <div class="card-body">
                <form class="container-fluid" method="POST" action="{{ isset($book) ? route('book.update',$book->id):route('book.store') }}"
                    enctype="multipart/form-data">
                    
                  @isset($book)
                      @method('PATCH')
                  @endisset
                    @csrf
                    <div class="row gy-2">
                        <div class="col-md-2"><label class="form-label">{{ __('site.title') }}</label></div>
                        <div class="col-md-10"><input type="text"
                                class="form-control  @error('title')
                        is-invalid
                        @enderror"
                                name="title" value="{{ isset($book) ? $book->title : old('title') }}">
                            @error('title')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-2"><label
                                class="form-label @error('ISBN')
                        is-invalid
                        @enderror">{{ __('site.ISBN') }}</label>
                        </div>
                        <div class="col-md-10"><input type="text" class="form-control" name="isbn"
                                value="{{ isset($book) ? $book->isbn : old('isbn') }}">
                            @error('isbn')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-2"><label class="form-label">{{ __('site.Book Cover') }}</label></div>
                        <div class="col-md-10"><input type="file"
                                class="form-control @error('file')
                        is-invalid
                        @enderror"
                                name="cover_image" value="{{ old('cover_image') }}">
                            @error('cover_image')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @if (isset($book))
                              <img src="{{ asset('storage/'.$book->cover_image) }}" alt="book-cover" class="col-12 max-h-20" id="book-cover-img">
                        @else
                             <img src="" alt="book-cover" class="d-none col-12 max-h-20" id="book-cover-img">
                        @endif
                       


                        {{-- test library --}}
                        <div class="col-md-2">
                            <label class="col-form-label" for="author_select">{{ __('site.Authors') }}</label>
                        </div>
                        @if (isset($book))
                            <div class="col-md-10">
                                <select id="author_select" multiple dir="rtl" name="author[]"
                                    class="@error('author[]')
                        'is-invalid'
                        @enderror">
                                    @foreach ($authors as $author)
                                        <option value={{ $author->id }}
                                            {{ $book->authors->contains($author) ? 'selected' : '' }}>{{ $author->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <div class="col-md-10">
                                <select id="author_select" multiple dir="rtl" name="author[]"
                                    class="@error('author[]')
                        'is-invalid'
                        @enderror">
                                    @foreach ($authors as $author)
                                        <option flex justify-content-between>
                                        <option value={{ $author->id }}>{{ $author->name }}</option>
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif



                        {{-- end of test --}}

                        <div class="col-md-2">
                            <label class="col-form-label">{{ __('site.Publisher') }}</label>
                        </div>
                        <div class="col-md-10 ">
                            <select
                                class="form-select publisher_selector @error('publisher')
                        is-invalid
                        @enderror"
                                aria-label="Default select example" name="publisher_id">
                                @foreach ($publishers as $publisher)
                                    @if (isset($book))
                                        <option value={{ $publisher->id }}
                                            {{ $book->publisher == $publisher ? 'selected' : '' }}>{{ $publisher->name }}
                                        </option>
                                    @else
                                        <option value={{ $publisher->id }}>{{ $publisher->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('publisher')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label class="col-form-label">{{ __('site.Category') }}</label>
                        </div>
                        <div class="col-md-10 ">
                            <select
                                class="form-select @error('category')
                        is-invalid
                        @enderror"
                                name="category_id">
                                 <option  disabled selected>
                                       {{ __('site.Choose Category..') }} </option>
                                @forelse($categories as $category)
                                     @if (isset($book))
                                    
                                        <option value={{ $category->id }}
                                            {{ $book->category == $category ? 'selected' : '' }}>{{ $category->name }}
                                        </option>
                                    @else
                                        <option value={{ $category->id }}>{{ $category->name }}</option>
                                    @endif
                                @empty
                                     <option value={{ $category->id }}>{{ $category->name }}</option>
                                @endforelse
                               
                            </select>
                            @error('category')
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
                                name="description" rows="3">{{ isset($book) ? $book->description : old('description') }}</textarea>
                            @error('description')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label class="col-form-label">{{ __('site.Number Of Pages') }}</label>
                        </div>
                        <div class="col-md-10">
                            <input
                                class="form-control @error('number_of_pages')
                        is-invalid
                        @enderror"
                                type="text" name="number_of_pages"
                                value="{{ isset($book) ? $book->number_of_pages : old('number_of_pages') }}">
                            @error('number_of_pages')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label class="col-form-label">{{ __('site.Number Of Copies') }}</label>
                        </div>
                        <div class="col-md-10">
                            <input
                                class="form-control @error('number_of_copies')
                        is-invalid
                        @enderror"
                                type="text" name="number_of_copies"
                                value=" {{ isset($book) ? $book->number_of_copies : old('number_of_copies') }}">
                            @error('number_of_copies')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label class="col-form-label">{{ __('site.Publish year') }}</label>
                        </div>
                        <div class="col-md-10">
                            <input
                                class="form-control @error('publish_year')
                        is-invalid
                        @enderror"
                                type="text" name="publish_year"
                                value=" {{ isset($book) ? $book->publish_year : old('publish_year') }}">
                            @error('publish_year')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label class="col-form-label">{{ __('site.Price') }}</label>
                        </div>
                        <div class="col-md-10">
                            <input
                                class="form-control @error('price')
                        is-invalid
                        @enderror"
                                type="text" name="price" value=" {{ isset($book) ? $book->price : old('price') }}">
                            @error('price')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class=" col-md-2">
                            <input class="btn btn-primary" type="submit" value="{{ isset($book) ? __('site.Update'): __('site.Create') }}">
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
            const img_cover = document.querySelector("#book-cover-img");
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
