<x-theme.default>
      <x-slot:title>
          {{ __('site.Dashboard') }}
    </x-slot>
    <x-dashboard-card :card-title="__('site.Books')" :card-value="$number_of_books" class="border-left-primary left-blue" >
        <i class='bx bxs-book-open bx-lg text-gray-300'></i>
    </x-dashboard-card>
     <x-dashboard-card :card-title="__('site.Categories')" :card-value="$number_of_books" class="border-left-primary left-yellow" >
        <i class='bx bxs-folder bx-lg text-gray-300'></i>
    </x-dashboard-card>
    <x-dashboard-card :card-title="__('site.Authors')" :card-value="$number_of_authors" class="border-left-primary left-green" >
        <i class='bx bxs-pen bx-lg text-gray-300'></i>
    </x-dashboard-card>
    <x-dashboard-card :card-title="__('site.Publishers')" :card-value="$number_of_books" class="border-left-primary left-red" >
        <i class='bx bxs-grid bx-lg text-gray-300'></i>
    </x-dashboard-card>
   
</x-theme.default>
