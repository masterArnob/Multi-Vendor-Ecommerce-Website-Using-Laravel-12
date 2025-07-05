@php
    $categories = App\Models\Category::where('status', 1)->orderBy('id', 'DESC')->get();
    //$subCategories = App\Models\SubCategory::where('status', 1)->orderBy('id', 'DESC')->get();
@endphp
<nav class="wsus__main_menu d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="relative_contect d-flex">
                    <div class="wsus_menu_category_bar">
                        <i class="far fa-bars"></i>
                    </div>
                    <ul class="wsus_menu_cat_item show_home toggle_menu">

                        @forelse ($categories as $category)
                            <li><a class="{{ count($category->subCategories) > 0 ? 'wsus__droap_arrow' : '' }}"
                                    href="{{ route('product-details.index', ['category' => $category->slug]) }}"><i class="{{ $category->icon }}"></i>
                                    {{ $category->name }} </a>
                                @if (count($category->subCategories) > 0)
                                    <ul class="wsus_menu_cat_droapdown">
                                        @forelse ($category->subCategories as $subCategory)
                                            <li><a href="{{ route('product-details.index', ['sub_category' => $subCategory->slug]) }}">{{ $subCategory->name }} <i
                                                        class="{{ count($subCategory->childCategories) > 0 ? 'fas fa-angle-right' : '' }}"></i></a>

                                                        @if (count($subCategory->childCategories) > 0)
                                                                                                            <ul class="wsus__sub_category">
                                                    @forelse ($subCategory->childCategories as $childCategory)
                                                        <li><a href="{{ route('product-details.index', ['child_category' => $childCategory->slug]) }}">{{ $childCategory->name }}</a> </li>
                                                    @empty
                                                        No Data Available
                                                    @endforelse

                                                </ul>
                                                        @endif

                                            </li>
                                        @empty
                                            No Data Available
                                        @endforelse


                                    </ul>
                                @endif
                            </li>
                        @empty
                            No data available
                        @endforelse


                    </ul>

                    <ul class="wsus__menu_item">
                        <li><a class="active" href="{{ route('home') }}">home</a></li>
                  
                        <li><a href="{{ route('vendor-list.index') }}">vendor</a></li>
                        <li><a href="{{ route('about-page.index') }}">About Us</a></li>
                          <li><a href="{{ route('term-page.index') }}">Terms & Conditions</a></li>
                           <li><a href="{{ route('order-track') }}">track order</a></li>
                     
            
                    </ul>
                  <ul class="wsus__menu_item wsus__menu_item_right">
    <li><a href="{{ route('contact-page.index') }}">contact</a></li>

    @if (Auth::guard('admin')->check())
        <!-- Admin is logged in -->
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    @elseif (Auth::guard('web')->check())
        <!-- User or Vendor is logged in -->
        @if (Auth::guard('web')->user()->role === 'user')
            <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
        @elseif (Auth::guard('web')->user()->role === 'vendor')
            <li><a href="{{ route('vendor.dashboard') }}">Dashboard</a></li>
        @endif
    @else
        <!-- No user is logged in -->
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
        <li><a href="{{ route('vendor.register.index') }}">Vendor Register</a></li>
    @endif
</ul>
                </div>
            </div>
        </div>
    </div>
</nav>
