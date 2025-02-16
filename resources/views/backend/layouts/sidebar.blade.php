<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <a href="{{ route('home') }}" class="brand-link" target="_blank">
   <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
   </a>
   <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item has-treeview">
               <a href="{{ route('admin.dashboard') }}"
                  class="nav-link @if (Route::is('admin.dashboard')) active @endif">
                  <i class="nav-icon fas fa-home"></i>
                  <p>
                     Dashboard
                  </p>
               </a>
            </li>

            <li class="nav-item has-treeview d-none">
               <a href="{{ route('admin.navbar.index') }}"
                  class="nav-link  @if (Route::is('admin.navbar.*')) active @endif">
                  <i class="nav-icon fas fa-bars"></i>
                  <p>
                     Navbar
                  </p>
               </a>
            </li>

            <li class="nav-item has-treeview">
               <a href="{{ route('admin.aboutus.index') }}"
                  class="nav-link  @if (Route::is('admin.aboutus.*')) active @endif">
                  <i class="nav-icon fas fa-bars"></i>
                  <p>
                     About us
                  </p>
               </a>
            </li>

            <li class="nav-item has-treeview">
               <a href="{{ route('admin.banner.index') }}"
                  class="nav-link @if (Route::is('admin.banner.*')) active @endif">
                  <i class="nav-icon fas fa-image"></i>
                  <p>
                     Banners
                  </p>
               </a>
            </li>

            <li class="nav-item has-treeview">
               <a href="{{ route('admin.testimonials.index') }}"
                  class="nav-link @if (Route::is('admin.testimonials.*')) active @endif">
                  <i class="fas fa-quote-left"></i>
                  <p>
                     Testimonials
                  </p>
               </a>
            </li>

            <li class="nav-item has-treeview">
               <a href="{{ route('admin.pages.index') }}"
                  class="nav-link  @if (Route::is('admin.pages.*')) active @endif">
                  <i class="nav-icon fas fa-file"></i>
                  <p>
                     Pages
                  </p>
               </a>
            </li>

            <li class="nav-header">Products</li>

            <li class="nav-item has-treeview">
               <a href="{{ route('admin.category.index') }}"
                  class="nav-link  @if (Route::is('admin.category.*')) active @endif">
                  <i class="nav-icon fas fa-sitemap"></i>
                  <p>
                     Categories
                  </p>
               </a>
            </li>

            <li class="nav-item has-treeview">
               <a href="{{ route('admin.product.index') }}"
                  class="nav-link @if (Route::is('admin.product.*')) active @endif">
                  <i class="nav-icon fas fa-cubes"></i>
                  <p>
                     Products
                  </p>
               </a>
            </li>

            <li class="nav-item has-treeview">
               <a href="{{ route('admin.order.index') }}"
                  class="nav-link @if (Route::is('admin.order.*')) active @endif">
                  <i class="nav-icon fas fa-chart-area"></i>
                  <p>
                     Orders
                  </p>
               </a>
            </li>
         </ul>
      </nav>
   </div>
</aside>