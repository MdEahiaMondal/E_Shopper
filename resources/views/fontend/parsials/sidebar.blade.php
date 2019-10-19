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
                                    <li><a class="{{ (request()->is('category-product/'.$category->id)) ? 'active':''}}" href="{{URL:: to('category-product/'.$category->id)}}"> <span class="pull-right">({{ $count = count(\App\Product::where('category_id', $category->id)->get()) }})</span>{{$category->name}}</a></li>
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
                            <li><a class="{{ (request()->is('brand-product/'.$brand->id)) ? 'active':''}}" href="{{URL:: to('brand-product/'.$brand->id)}}"> <span class="pull-right">(50)</span>{{$brand->name}}</a></li>
                        @endforeach

                    </ul>
                </div>
            </div><!--/brands_products-->

            <div class="price-range"><!--price-range-->
                <h2>Price Range</h2>
                <div class="well text-center">
                    <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                    <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                </div>

            </div><!--/price-range-->

            <div class="shipping text-center"><!--shipping-->
                <img src="{{asset('frontend/images/home/shipping.jpg')}}" alt="" />
            </div><!--/shipping-->

        </div>
    </div>
</div>
