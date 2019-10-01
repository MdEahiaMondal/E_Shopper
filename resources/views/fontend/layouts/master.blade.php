@include('fontend.parsials.header')
    <?php
        $url= Request::path()
    ?>
@if($url =='/') {{--currentController() from common helper--}}
    <section id="slider_section" class=""><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12 ">
                    <div id="slider-carousel" class="carousel" data-ride="carousel">
                        <div class=" carousel-inner">
                            <?php
                            $all_sliders = \Illuminate\Support\Facades\DB::table('sliders')->where('status',1)->get();
                            $i = 0;
                            foreach($all_sliders as $slider){?>
                            <div class=" item <?php if($i == 1){echo 'active';}?>">
                                <div>
                                    <img style="width: 100%; height: 400px;" src="{{asset('images/slider_image/'.$slider->image)}}" class="girl imag-responsive" alt="" />
                                </div>
                            </div>
                            <?php $i++; }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/slider-->
@endif

<section>
    <div class="container">
        <div class="row">
            @if($url !=='email/verify' and $url !=='password/reset' and $url !=='login' and $url !=='register' and $url !=='user-profile' and $url !=='wishlist.index' and Route::getFacadeRoot()->current()->uri() !=='contact-us' and Route::getFacadeRoot()->current()->uri() !=='insert-payment' and Route::getFacadeRoot()->current()->uri() !=='payment' and Route::getFacadeRoot()->current()->uri() !=='show-cart' and Route::getFacadeRoot()->current()->uri() !=='checkout' and Route::getFacadeRoot()->current()->uri() !=='login-check')
                @include('fontend.parsials.sidebar')
            @endif

            <div class="col-sm-9 padding-right">
                @yield('content')
            </div>
        </div>
    </div>
</section>
@include('fontend.parsials.footer')