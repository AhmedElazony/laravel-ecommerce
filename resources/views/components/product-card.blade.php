@props(['product'])

<div class="single-product">
    <div class="product-image">
        <img src="{{ $product->image }}" alt="{{ $product->name . ' image'}}">

        @if ($product->sale_percent !== 0)
            <span class="sale-tag">{{ $product->sale_percent }}%</span>
        @endif

        @if($product->new ?? false)
            <span class="new-tag text-left">New</span>
        @endif
        <div class="button">
            <a href="{{ route('products.show', $product->slug)  }}" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
        </div>
    </div>
    <div class="product-info">
        <span class="category">{{ $product->category->name ?? '' }}</span>
        <h4 class="title">
            <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
        </h4>
        <ul class="review">
            @for($i = 0; $i < $product->rating; $i++)
                <li><i class="lni lni-star-filled"></i></li>
            @endfor
            @if($product->rating == 0)
                <li><i class="lni lni-star"></i></li>
                <li><i class="lni lni-star"></i></li>
                <li><i class="lni lni-star"></i></li>
                <li><i class="lni lni-star"></i></li>
                <li><i class="lni lni-star"></i></li>
            @endif
            <li><span>4.0 Review(s)</span></li>
        </ul>
        <div class="price">
            @if ($product->sale_percent !== 0)
                <span>{{ Currency::format($product->compare_price) }}</span>
                <span class="discount-price">{{ Currency::format($product->price) }}</span>
            @else
                <span>{{ Currency::format($product->price) }}</span>
            @endif
        </div>
    </div>
</div>
