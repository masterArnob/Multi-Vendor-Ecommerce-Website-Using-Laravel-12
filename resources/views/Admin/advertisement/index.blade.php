@extends('admin.layout.master')
@section('content')
    @php
        $ad_one = json_decode(@$ad_one->value);
        $ad_two = json_decode(@$ad_two->value);
        $ad_three = json_decode(@$ad_three->value);
        $ad_four = json_decode(@$ad_four->value);
        $ad_five = json_decode(@$ad_five->value);
        $ad_six = json_decode(@$ad_six->value);
        $ad_seven = json_decode(@$ad_seven->value);
    @endphp
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="#tabs-home-8" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">Home Advertisement 1</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tabs-profile-8" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Home Advertisement 2</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tabs-activity-8" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Home Advertisement 3</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tabs-ad4-8" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Home Advertisement 4</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tabs-ad5-8" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Home Advertisement 5</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tabs-ad6-8" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Home Advertisement 6</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tabs-ad7-8" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Home Advertisement 7</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <!-- Home Advertisement 1 -->
                <div class="tab-pane fade active show" id="tabs-home-8" role="tabpanel">
                    <h4>Home Advertisement 1</h4>
                    <div>
                        <form action="{{ route('admin.ad.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3 align-items-center">
                                <h3>Home Page Banner One</h3>
                                <input type="hidden" name="home_page_banner_one" value="home_page_banner_one">

                                @if (@$ad_one[0]->banner !== null)
                                    <div class="col-md-7 mb-2">
                                        <div class="img-responsive img-responsive-3x1 rounded-3 border"
                                            style="background-image: url({{ asset(@$ad_one[0]->banner) }})"></div>
                                    </div>
                                @endif

                                <div class="col-md-7">
                                    <div class="form-label">Banner</div>
                                    <input type="file" name="banner" class="form-control">
                                    <x-input-error :messages="$errors->get('banner')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Banner URL</div>
                                    <input type="url" name="banner_url" value="{{ @$ad_one[0]->banner_url }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('banner_url')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Occassion (ex: black friday/eid)</div>
                                    <input type="text" name="occassion" value="{{ @$ad_one[0]->occassion }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('occassion')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Offer (ex:70/80) %</div>
                                    <input type="text" name="offer" value="{{ @$ad_one[0]->offer }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('offer')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7 mt-3">
                                    <div class="form-label">Status</div>
                                    <select name="status" class="form-select">
                                        <option value="">Select</option>
                                        <option @selected(@$ad_one[0]->status == 1) value="1">Active</option>
                                        <option @selected(@$ad_one[0]->status == 0) value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Home Advertisement 2 -->
                <div class="tab-pane fade" id="tabs-profile-8" role="tabpanel">
                    <h4>Home Advertisement 2</h4>
                    <form action="{{ route('admin.ad.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3 align-items-center">
                            <h3>Home Page Banner Two</h3>
                            <input type="hidden" name="home_page_banner_two" value="home_page_banner_two">

                            @if (@$ad_two[0]->banner_one !== null)
                                <div class="col-md-7 mb-2">
                                    <div class="img-responsive img-responsive-3x1 rounded-3 border"
                                        style="background-image: url({{ asset(@$ad_two[0]->banner_one) }})"></div>
                                </div>
                            @endif

                            <div class="col-md-7">
                                <div class="form-label">Banner One</div>
                                <input type="file" name="banner_one" class="form-control">
                                <x-input-error :messages="$errors->get('banner_one')" class="mt-2 text-danger" />
                            </div>

                            <div class="col-md-7">
                                <div class="form-label">Banner URL</div>
                                <input type="url" name="banner_one_url" value="{{ @$ad_two[0]->banner_one_url }}"
                                    class="form-control">
                                <x-input-error :messages="$errors->get('banner_one_url')" class="mt-2 text-danger" />
                            </div>

                            <div class="col-md-7">
                                <div class="form-label">Product/Category</div>
                                <input type="text" name="occassion_one" value="{{ @$ad_two[0]->occassion_one }}"
                                    class="form-control">
                                <x-input-error :messages="$errors->get('occassion_one')" class="mt-2 text-danger" />
                            </div>

                            <div class="col-md-7">
                                <div class="form-label">Offer (ex:70/80) %</div>
                                <input type="text" name="offer_one" value="{{ @$ad_two[0]->offer_one }}"
                                    class="form-control">
                                <x-input-error :messages="$errors->get('offer_one')" class="mt-2 text-danger" />
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mt-4">
                            @if (@$ad_two[1]->banner_two !== null)
                                <div class="col-md-7 mb-2">
                                    <div class="img-responsive img-responsive-3x1 rounded-3 border"
                                        style="background-image: url({{ asset(@$ad_two[1]->banner_two) }})"></div>
                                </div>
                            @endif

                            <div class="col-md-7">
                                <div class="form-label">Banner Two</div>
                                <input type="file" name="banner_two" class="form-control">
                                <x-input-error :messages="$errors->get('banner_two')" class="mt-2 text-danger" />
                            </div>

                            <div class="col-md-7">
                                <div class="form-label">Banner URL</div>
                                <input type="url" name="banner_two_url" value="{{ @$ad_two[1]->banner_two_url }}"
                                    class="form-control">
                                <x-input-error :messages="$errors->get('banner_two_url')" class="mt-2 text-danger" />
                            </div>

                            <div class="col-md-7">
                                <div class="form-label">Product/Category</div>
                                <input type="text" name="occassion_two" value="{{ @$ad_two[1]->occassion_two }}"
                                    class="form-control">
                                <x-input-error :messages="$errors->get('occassion_two')" class="mt-2 text-danger" />
                            </div>

                            <div class="col-md-7">
                                <div class="form-label">Type (ex: New Collection)</div>
                                <input type="text" name="offer_two" value="{{ @$ad_two[1]->offer_two }}"
                                    class="form-control">
                                <x-input-error :messages="$errors->get('offer_two')" class="mt-2 text-danger" />
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-7">
                                <div class="form-label">Status</div>
                                <select name="status" class="form-select">
                                    <option value="">Select</option>
                                    <option @selected(@$ad_two[0]->status == 1) value="1">Active</option>
                                    <option @selected(@$ad_two[0]->status == 0) value="0">Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <!-- Home Advertisement 3 (FIXED SECTION) -->
                <div class="tab-pane fade" id="tabs-activity-8" role="tabpanel">
                    <h4>Home Advertisement 3</h4>
                    <div>
                        <form action="{{ route('admin.ad.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="home_page_banner_three" value="home_page_banner_three">

                            <!-- Banner 1 Section -->
                            <div class="row g-3 align-items-center mt-4">
                                <h3>Banner 1</h3>
                                @if (@$ad_three[0]->banner_one !== null)
                                    <div class="col-md-7 mb-2">
                                        <div class="img-responsive img-responsive-3x1 rounded-3 border"
                                            style="background-image: url({{ asset(@$ad_three[0]->banner_one) }})"></div>
                                    </div>
                                @endif

                                <div class="col-md-7">
                                    <div class="form-label">Banner</div>
                                    <input type="file" name="banner_one" class="form-control">
                                    <x-input-error :messages="$errors->get('banner_one')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Banner URL</div>
                                    <input type="url" name="banner_one_url" value="{{ @$ad_three[0]->banner_one_url }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('banner_one_url')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Product/Category</div>
                                    <input type="text" name="occassion_one" value="{{ @$ad_three[0]->occassion_one }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('occassion_one')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Offer</div>
                                    <input type="text" name="offer_one" value="{{ @$ad_three[0]->offer_one }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('offer_one')" class="mt-2 text-danger" />
                                </div>
                            </div>

                            <!-- Banner 2 Section (FIXED) -->
                            <div class="row g-3 align-items-center mt-4">
                                <h3>Banner 2</h3>
                                @if (@$ad_three[1]->banner_two !== null)
                                    <div class="col-md-7 mb-2">
                                        <div class="img-responsive img-responsive-3x1 rounded-3 border"
                                            style="background-image: url({{ asset(@$ad_three[1]->banner_two) }})"></div>
                                    </div>
                                @endif

                                <div class="col-md-7">
                                    <div class="form-label">Banner</div>
                                    <input type="file" name="banner_two" class="form-control">
                                    <x-input-error :messages="$errors->get('banner_two')" class="mt-2 text-danger" />
                                </div>

                                <!-- FIXED DIV TAG HERE -->
                                <div class="col-md-7">
                                    <div class="form-label">Banner URL</div>
                                    <input type="url" name="banner_two_url" value="{{ @$ad_three[1]->banner_two_url }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('banner_two_url')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Product/Category</div>
                                    <input type="text" name="occassion_two" value="{{ @$ad_three[1]->occassion_two }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('occassion_two')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Type</div>
                                    <input type="text" name="offer_two" value="{{ @$ad_three[1]->offer_two }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('offer_two')" class="mt-2 text-danger" />
                                </div>
                            </div>

                            <!-- Banner 3 Section -->
                            <div class="row g-3 align-items-center mt-4">
                                <h3>Banner 3</h3>
                                @if (@$ad_three[2]->banner_three !== null)
                                    <div class="col-md-7 mb-2">
                                        <div class="img-responsive img-responsive-3x1 rounded-3 border"
                                            style="background-image: url({{ asset(@$ad_three[2]->banner_three) }})"></div>
                                    </div>
                                @endif

                                <div class="col-md-7">
                                    <div class="form-label">Banner</div>
                                    <input type="file" name="banner_three" class="form-control">
                                    <x-input-error :messages="$errors->get('banner_three')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Banner URL</div>
                                    <input type="url" name="banner_three_url" value="{{ @$ad_three[2]->banner_three_url }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('banner_three_url')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Product/Category</div>
                                    <input type="text" name="occassion_three" value="{{ @$ad_three[2]->occassion_three }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('occassion_three')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Offer</div>
                                    <input type="text" name="offer_three" value="{{ @$ad_three[2]->offer_three }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('offer_three')" class="mt-2 text-danger" />
                                </div>
                            </div>

                            <!-- Status Section -->
                            <div class="row mt-4">
                                <div class="col-md-7">
                                    <div class="form-label">Status</div>
                                    <select name="status" class="form-select">
                                        <option value="">Select</option>
                                        <option @selected(@$ad_three[0]->status == 1) value="1">Active</option>
                                        <option @selected(@$ad_three[0]->status == 0) value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Home Advertisement 4 -->
                <div class="tab-pane fade" id="tabs-ad4-8" role="tabpanel">
                    <h4>Home Advertisement 4</h4>
                    <div>
                        <form action="{{ route('admin.ad.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="home_page_banner_four" value="home_page_banner_four">

                            <!-- Banner 1 Section -->
                            <div class="row g-3 align-items-center mt-4">
                                <h3>Banner 1</h3>
                                @if (@$ad_four[0]->banner_one !== null)
                                    <div class="col-md-7 mb-2">
                                        <div class="img-responsive img-responsive-3x1 rounded-3 border"
                                            style="background-image: url({{ asset(@$ad_four[0]->banner_one) }})"></div>
                                    </div>
                                @endif

                                <div class="col-md-7">
                                    <div class="form-label">Banner</div>
                                    <input type="file" name="banner_one" class="form-control">
                                    <x-input-error :messages="$errors->get('banner_one')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Banner URL</div>
                                    <input type="url" name="banner_one_url" value="{{ @$ad_four[0]->banner_one_url }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('banner_one_url')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Product/Category</div>
                                    <input type="text" name="occassion_one" value="{{ @$ad_four[0]->occassion_one }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('occassion_one')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Offer Name</div>
                                    <input type="text" name="offer_one_name" value="{{ @$ad_four[0]->offer_one_name }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('offer_one')" class="mt-2 text-danger" />
                                </div>


                                  <div class="col-md-7">
                                    <div class="form-label">Offer</div>
                                    <input type="text" name="offer_one" value="{{ @$ad_four[0]->offer_one }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('offer_one')" class="mt-2 text-danger" />
                                </div>
                            </div>

                            <!-- Status Section -->
                            <div class="row mt-4">
                                <div class="col-md-7">
                                    <div class="form-label">Status</div>
                                    <select name="status" class="form-select">
                                        <option value="">Select</option>
                                        <option @selected(@$ad_four[0]->status == 1) value="1">Active</option>
                                        <option @selected(@$ad_four[0]->status == 0) value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Home Advertisement 5 -->
                <div class="tab-pane fade" id="tabs-ad5-8" role="tabpanel">
                    <h4>Product Details Page Advertisement 5</h4>
                    <div>
                          <form action="{{ route('admin.ad.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="home_page_banner_five" value="home_page_banner_five">

                            <!-- Banner 1 Section -->
                            <div class="row g-3 align-items-center mt-4">
                                <h3>Banner 1</h3>
                                @if (@$ad_five[0]->banner_one !== null)
                                    <div class="col-md-7 mb-2">
                                        <div class="img-responsive img-responsive-3x1 rounded-3 border"
                                            style="background-image: url({{ asset(@$ad_five[0]->banner_one) }})"></div>
                                    </div>
                                @endif

                                <div class="col-md-7">
                                    <div class="form-label">Banner</div>
                                    <input type="file" name="banner_one" class="form-control">
                                    <x-input-error :messages="$errors->get('banner_one')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Banner URL</div>
                                    <input type="url" name="banner_one_url" value="{{ @$ad_five[0]->banner_one_url }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('banner_one_url')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Product/Category</div>
                                    <input type="text" name="occassion_one" value="{{ @$ad_five[0]->occassion_one }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('occassion_one')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Offer Name</div>
                                    <input type="text" name="offer_one_name" value="{{ @$ad_five[0]->offer_one_name }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('offer_one')" class="mt-2 text-danger" />
                                </div>


                                  <div class="col-md-7">
                                    <div class="form-label">Offer</div>
                                    <input type="text" name="offer_one" value="{{ @$ad_five[0]->offer_one }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('offer_one')" class="mt-2 text-danger" />
                                </div>
                            </div>

                            <!-- Status Section -->
                            <div class="row mt-4">
                                <div class="col-md-7">
                                    <div class="form-label">Status</div>
                                    <select name="status" class="form-select">
                                        <option value="">Select</option>
                                        <option @selected(@$ad_five[0]->status == 1) value="1">Active</option>
                                        <option @selected(@$ad_five[0]->status == 0) value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Home Advertisement 6 -->
                <div class="tab-pane fade" id="tabs-ad6-8" role="tabpanel">
                    <h4>Home Advertisement 6</h4>
                    <div>
                            <form action="{{ route('admin.ad.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="home_page_banner_six" value="home_page_banner_six">

                            <!-- Banner 1 Section -->
                            <div class="row g-3 align-items-center mt-4">
                                <h3>Banner 1</h3>
                                @if (@$ad_six[0]->banner_one !== null)
                                    <div class="col-md-7 mb-2">
                                        <div class="img-responsive img-responsive-3x1 rounded-3 border"
                                            style="background-image: url({{ asset(@$ad_six[0]->banner_one) }})"></div>
                                    </div>
                                @endif

                                <div class="col-md-7">
                                    <div class="form-label">Banner</div>
                                    <input type="file" name="banner_one" class="form-control">
                                    <x-input-error :messages="$errors->get('banner_one')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Banner URL</div>
                                    <input type="url" name="banner_one_url" value="{{ @$ad_six[0]->banner_one_url }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('banner_one_url')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Product/Category</div>
                                    <input type="text" name="occassion_one" value="{{ @$ad_six[0]->occassion_one }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('occassion_one')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Offer Name</div>
                                    <input type="text" name="offer_one_name" value="{{ @$ad_six[0]->offer_one_name }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('offer_one')" class="mt-2 text-danger" />
                                </div>


                                  <div class="col-md-7">
                                    <div class="form-label">Offer</div>
                                    <input type="text" name="offer_one" value="{{ @$ad_six[0]->offer_one }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('offer_one')" class="mt-2 text-danger" />
                                </div>
                            </div>

                            <!-- Status Section -->
                            <div class="row mt-4">
                                <div class="col-md-7">
                                    <div class="form-label">Status</div>
                                    <select name="status" class="form-select">
                                        <option value="">Select</option>
                                        <option @selected(@$ad_six[0]->status == 1) value="1">Active</option>
                                        <option @selected(@$ad_six[0]->status == 0) value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Home Advertisement 7 -->
                <div class="tab-pane fade" id="tabs-ad7-8" role="tabpanel">
                    <h4>Home Advertisement 7</h4>
                    <form action="{{ route('admin.ad.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3 align-items-center">
                            <h3>Home Page Banner Seven</h3>
                            <input type="hidden" name="home_page_banner_seven" value="home_page_banner_seven">

                            @if (@$ad_seven[0]->banner_one !== null)
                                <div class="col-md-7 mb-2">
                                    <div class="img-responsive img-responsive-3x1 rounded-3 border"
                                        style="background-image: url({{ asset(@$ad_seven[0]->banner_one) }})"></div>
                                </div>
                            @endif

                            <div class="col-md-7">
                                <div class="form-label">Banner One</div>
                                <input type="file" name="banner_one" class="form-control">
                                <x-input-error :messages="$errors->get('banner_one')" class="mt-2 text-danger" />
                            </div>

                            <div class="col-md-7">
                                <div class="form-label">Banner URL</div>
                                <input type="url" name="banner_one_url" value="{{ @$ad_seven[0]->banner_one_url }}"
                                    class="form-control">
                                <x-input-error :messages="$errors->get('banner_one_url')" class="mt-2 text-danger" />
                            </div>

                            <div class="col-md-7">
                                <div class="form-label">Product/Category</div>
                                <input type="text" name="occassion_one" value="{{ @$ad_seven[0]->occassion_one }}"
                                    class="form-control">
                                <x-input-error :messages="$errors->get('occassion_one')" class="mt-2 text-danger" />
                            </div>

                            <div class="col-md-7">
                                <div class="form-label">Offer (ex:70/80) %</div>
                                <input type="text" name="offer_one" value="{{ @$ad_seven[0]->offer_one }}"
                                    class="form-control">
                                <x-input-error :messages="$errors->get('offer_one')" class="mt-2 text-danger" />
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mt-4">
                            @if (@$ad_seven[1]->banner_two !== null)
                                <div class="col-md-7 mb-2">
                                    <div class="img-responsive img-responsive-3x1 rounded-3 border"
                                        style="background-image: url({{ asset(@$ad_seven[1]->banner_two) }})"></div>
                                </div>
                            @endif

                            <div class="col-md-7">
                                <div class="form-label">Banner Two</div>
                                <input type="file" name="banner_two" class="form-control">
                                <x-input-error :messages="$errors->get('banner_two')" class="mt-2 text-danger" />
                            </div>

                            <div class="col-md-7">
                                <div class="form-label">Banner URL</div>
                                <input type="url" name="banner_two_url" value="{{ @$ad_seven[1]->banner_two_url }}"
                                    class="form-control">
                                <x-input-error :messages="$errors->get('banner_two_url')" class="mt-2 text-danger" />
                            </div>

                            <div class="col-md-7">
                                <div class="form-label">Product/Category</div>
                                <input type="text" name="occassion_two" value="{{ @$ad_seven[1]->occassion_two }}"
                                    class="form-control">
                                <x-input-error :messages="$errors->get('occassion_two')" class="mt-2 text-danger" />
                            </div>

                            <div class="col-md-7">
                                <div class="form-label">Type (ex: New Collection)</div>
                                <input type="text" name="offer_two" value="{{ @$ad_seven[1]->offer_two }}"
                                    class="form-control">
                                <x-input-error :messages="$errors->get('offer_two')" class="mt-2 text-danger" />
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-7">
                                <div class="form-label">Status</div>
                                <select name="status" class="form-select">
                                    <option value="">Select</option>
                                    <option @selected(@$ad_seven[0]->status == 1) value="1">Active</option>
                                    <option @selected(@$ad_seven[0]->status == 0) value="0">Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection