
<div class="cd-quick-view">
    <div class="cd-slider-wrapper">
        <ul class="cd-slider">
            <li class="selected">
                <img src="" alt="Product 1">
            </li>
        </ul>
    </div>

    <div class="cd-item-info">
        <h2>Produt Name</h2>
        <p>Price: <span class="name"></span> tk</p>
        <p>Brand : <span class="brand"></span> </p>
        <p>Category : <span class="category"></span></p>
        <p class="description"></p>

        <ul class="cd-item-action">

                <span>
                    <form action="{{url('add-cart')}}" method="post">
                        @csrf
                       <label>Quantity:</label>
                       <input type="text" style=" width: 37px; height: 24px; display: inline-block;" class="productQuantity" name="qty" value="1" />
                        <input type="hidden" class="product_id" name="product_id" value="">
                        <button type="submit" class="btn btn-default cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        <a class="btn btn-default cart" href="{{ route('add.wishlist',$product->slug) }}"><i class="fa fa-plus-square"></i>Add to wishlist</a>
                    </form>
                </span>
        </ul> <!-- cd-item-action -->
    </div> <!-- cd-item-info -->
    <a href="#0" class="cd-close">Close</a>
</div> <!-- cd-quick-view -->

