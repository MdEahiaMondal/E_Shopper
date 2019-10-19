<form action="{{url('search-product')}}" method="post">
    @csrf
    <div class="col-sm-9">
        <div class="search_box pull-right">
            <input type="text" name="product_search" placeholder="Search"/>
        </div>
    </div>

    <div class="col-sm-2">
        <select class="pull-right" style="height: 35px;" name="" id="">
            <option value="">Select category</option>
            {{$categories = \App\Category::where('status', 1)->get()}}
            @if($categories)
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            @else
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endif
        </select>
    </div>

    <div class="col-sm-1">
        <div class="search_button">
            <input type="submit" class="btn" value="Search">
        </div>

    </div>
</form>


{{--
@if($url != 'email/verify' and $url != 'login' and $url != 'register' and $url != 'user-profile' and $url != 'wishlist.index' and $url != 'contact-us' and $url != 'insert-payment' and $url != 'show-cart' and $url != 'payment' and $url != 'checkout')

    <form action="{{url('search-product')}}" method="post">
        @csrf
        <div class="col-sm-9">
            <div class="search_box pull-right">
                <input type="text" name="product_search" placeholder="Search"/>
            </div>
        </div>

        <div class="col-sm-2">
            <select class="pull-right" style="height: 35px;" name="" id="">
                <option value="">Select category</option>
                {{$categories = \App\Category::where('status', 1)->get()}}
                @if($categories)
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                @else
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endif
            </select>
        </div>

        <div class="col-sm-1">
            <div class="search_button">
                <input type="submit" class="btn" value="Search">
            </div>

        </div>
    </form>
@endif--}}
