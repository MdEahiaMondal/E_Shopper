<div class="sidebar">
    <div class="col-sm-3">
        <div class="left-sidebar">
            <h2>Category</h2>
                <div class="brands_products"><!--brands_products-->
                    <div class="brands-name">
                        <ul class="nav nav-pills nav-stacked">
                            <?php
                            $categories = \App\Category::where('status', 1)->get();
                            ?>
                            @foreach($categories as $category)
                                    <li><a class="{{ (request()->is('category-product/'.$category->id)) ? 'active':''}}" href="{{URL:: to('category-product/'.$category->id)}}"> <span class="pull-right">( {{ $count = count(\App\Product::where(['category_id'=>$category->id, 'deleted_at'=>null])->get()) }} )</span>{{$category->name}}</a></li>
                            @endforeach

                        </ul>
                    </div>
                </div>


            <div class="brands_products"><!--brands_products-->
                <h2>Brands</h2>
                <div class="brands-name">
                    <ul class="nav nav-pills nav-stacked">
                        <?php
                        $brands = \App\Brand::where('status', 1)->get();
                        ?>
                        @foreach($brands as $brand)
                            <li><a class="{{ (request()->is('brand-product/'.$brand->id)) ? 'active':''}}" href="{{URL:: to('brand-product/'.$brand->id)}}"> <span class="pull-right">( {{ $count = count(\App\Product::where(['brand_id' =>$brand->id, 'deleted_at'=>null])->get()) }} )</span>{{$brand->name}}</a></li>
                        @endforeach

                    </ul>
                </div>
            </div><!--/brands_products-->

            <div class=""><!--price-range-->
                <h2>Price Range</h2>
                <div class="well text-center">

                    <div id="priceSlider"></div>

                    @php
                        $minPrice = \App\Product::min('price');
                        $maxPrice = \App\Product::max('price');

                    @endphp
                    <input id="maxprice" name="maxprice" readonly value="{{ $maxPrice }}"  type="hidden">
                    <input id="miniPrice" name="miniPrice" readonly value="{{ $minPrice }}" type="hidden">

                    <form action="{{ route('price.range') }}" method="post">
                        @csrf
                        <div class="form-group row" style="margin-top: 7px;">
                            <div class="col-xs-4 pull-left">
                                <input class="form-control" id="minimumPrice"  name="minimumPrice" readonly type="text">
                            </div>
                            <div class="col-xs-4 pull-right">
                                <input class="form-control" id="maximumPrice" name="maximumPrice" readonly type="text">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-sm"  value="Filter">
                    </form>

                </div>


            </div><!--/price-range-->

            <div class="shipping text-center"><!--shipping-->
                <img src="{{asset('frontend/images/home/shipping.jpg')}}" alt="" />
            </div><!--/shipping-->

        </div>
    </div>
</div>


