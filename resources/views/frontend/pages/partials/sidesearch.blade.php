<style>
    input[type="range"]::-webkit-slider-runnable-track {
        background: blue;
    }
    input[type="range"]::-webkit-slider-thumb {
        background: darkblue;
    }
    input[type="range"] {
        accent-color: blue;
    }
</style>

<div class="prices categories">
    <div class="categories-name">
        <h6>Suitable For</h6>
    </div>
    <div class="price-list">
        <ul>
            @foreach($search_suitable_for_groups as $search_suitable_for_group)
            <li class="checkbox"><input type="checkbox" class="filter_suitable_for"
                    id="filter_suitable_for_{{ $loop->iteration}}" value="{{ $search_suitable_for_group['slug'] }}">
                <label class="ps-3" for="filter_suitable_for_{{ $loop->iteration}}"><span>{{ $search_suitable_for_group['title'] }}</span></label>
            </li>
            @endforeach
        </ul>
    </div>
</div>

@if($categories->isNotEmpty())
<div class="prices categories mt-4">
    <div class="categories-name">
        <span>Category</span>
    </div>
    <div class="price-list">
        <ul>
            @foreach($categories as $category)
            <li class="checkbox"> <input type="checkbox" class="filter_categories"
                    id="filter_categories_{{ $loop->iteration}}" value="{{ $category['slug'] }}"
                    @if($categorySlug == $category['slug']) {{ "checked=checked" }} @endif>
                <label class="ps-3" for="filter_categories_{{ $loop->iteration}}"><span>{{ $category['category_name'] }}</span></label>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<div class="prices price-range-slider categories mt-4">
    <div class="categories-name">
        <span>Filter by Price : <span id="selectedprice">{{ ($min_price) }}</span></span>
    </div>
    <div class="p  ">
        <div class="min-max">
        Min:  <span> {{ ($min_price) }}</span>
        </div>
        <input type="range" value="{{ str_replace(',','',$min_price) }}" min="{{ str_replace(',','',$min_price) }}"
            max="{{ str_replace(',','',$max_price) }} " class="priceSlider" id="priceRange" />
        <div class="min-max">
        Max: <span>{{ ($max_price) }} </span>
        </div>
    </div>
</div>


<div class="prices categories mt-4">
    <div class="categories-name">
        <span>Size</span>
    </div>
    @if($sizes->isNotEmpty())
    <div class="price-list">
        <ul>
            @foreach($sizes as $size)
            <li class="checkbox"> <input type="checkbox" class="filter_sizes" id="filter_sizes_{{ $loop->iteration}}"
                    value="{{ $size->size }}">
                <label class="ps-3" for="filter_sizes_{{ $loop->iteration}}"><span>{{ $size->size }}</span></label>
            </li>
            @endforeach
         </ul>
      </div>
   @endif
</div>
