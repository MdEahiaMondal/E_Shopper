
@error('liveSearch')
<div class="alert alert-danger">{{ $message }}</div>
@enderror

<form action="{{ route('search.product') }}" method="get">
    @csrf
    <div class="col-sm-9">
        <div class="search_box pull-right">
            <input type="text" name="liveSearch" id="liveSearch" placeholder="Search"/>
            <div id="autocompleteResultShow"></div>
        </div>
    </div>

    <div class="col-sm-2">
        <select class="pull-right" style="height: 35px;" name="category_id" id="category_id">
            <option value="">Select category</option>

            @php
                $categories = \App\Category::where('status', 1)->get()
            @endphp

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


