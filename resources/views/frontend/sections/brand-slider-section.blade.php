    <section id="wsus__brand_sleder" class="brand_slider_2">
        <div class="container">
            <div class="brand_border">
                <div class="row brand_slider">
                   
                
                   
                    @forelse ($brands as $brand)
                  
                
                     <div class="col-xl-2">
                        <div class="wsus__brand_logo">
                            <img src="{{ $brand->logo }}" alt="brand" class="img-fluid w-100">
                        </div>
                    </div>
               
                    @empty
                        No Data Available
                    @endforelse
                </div>
            </div>
        </div>
    </section>