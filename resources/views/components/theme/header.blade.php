<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="p-2 flex h-100  justify-content-center align-items-center">
            <h1 class="h3 mb-0 text-gray-800">{{ $slot }}</h1>
    </div>

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class='bx bx-menu'></i>
    </button>



    <!-- Topbar Navbar -->
    <ul class="navbar-nav {{ app()->getLocale() == 'ar' ? 'mr-auto' : 'ml-auto' }}">
        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow ">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->email }}
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu  {{ app()->getLocale()=='ar'?'dropdown-menu-right':'dropdown-menu-left'  }}   shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline  w-100" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item" type="submit">
                        {{ __('site.Log Out') }}
                    </button>
                </form>
                {{-- <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form> --}}
            </div>
        </li>






    </ul>

</nav>
