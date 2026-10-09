<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar" >

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><img width="150" height="80" src="{{ asset('storage/bookstore_Logo.png') }}" alt="Logo"></div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
        <a class="nav-link {{ app()->getLocale() == 'ar' ? 'ar' : ''}}  {{ request()->is('admin/dashboard*') ? '' : 'text-white-50'  }} " href={{ route('admin') }}>
            <i class='bx bxs-dashboard'></i>
            <span>{{ __('site.Dashboard') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ app()->getLocale() == 'ar' ? 'ar' : ''}}  {{ request()->is('admin/book*') ? '' : 'text-white-50'  }}" href={{ route('book.index') }}>
            <i class='bx bx-book' ></i>
            <span>{{ __('site.Books') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ app()->getLocale() == 'ar' ? 'ar' : ''}} {{ request()->is('admin/category*') ? '' : 'text-white-50' }}" href={{ route('category.index') }}>
            <i class='bx bx-list-ul'></i>
            <span>{{ __('site.Catgories') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ app()->getLocale() == 'ar' ? 'ar' : ''}} {{ request()->is('admin/publisher*') ? '' : 'text-white-50' }}" href={{ route('publisher.index') }}>
            <i class='bx bx-grid'></i>
            <span>{{ __('site.Publishers') }}</span>
        </a>
    </li>
      <li class="nav-item">
        <a class="nav-link {{ app()->getLocale() == 'ar' ? 'ar' : ''}} {{ request()->is('admin/author*') ? '' : 'text-white-50' }}" href={{ route('author.index') }}>
            <i class='bx bx-pen'></i>
            <span>{{ __('site.Authors') }}</span>
        </a>
    </li>
     <li class="nav-item">
        <a class="nav-link {{ app()->getLocale() == 'ar' ? 'ar' : ''}} {{ request()->is('admin/users*') ? '' : 'text-white-50' }}" href={{ route('user.index') }}>
           <i class='bx bx-group'></i>
            <span>{{ __('site.Users') }}</span>
        </a>
    </li>
         <li class="nav-item">
        <a class="nav-link {{ app()->getLocale() == 'ar' ? 'ar' : ''}} {{ request()->is('admin/cart*') ? '' : 'text-white-50' }}" href={{ route('admin.orders') }}>
          <i class='bx bx-cart-alt'></i>
            <span>{{ __('site.Procurement') }}</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle">   
        </button>
    </div>



</ul>
