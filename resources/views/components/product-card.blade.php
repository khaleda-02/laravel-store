<div class="single-product">
    <div class="product-image">
        <img src="{{ $product->image_url }}" alt="#">
        @if ($product->sale_tag)
            <span class="sale-tag">-{{ $product->sale_tag }}%</span>
        @endif
        <div class="button">
            <form action="{{ route('cart.store') }}" method="post">
                @csrf
                <input type="text" hidden value="{{ $product->id }}" name="product_id" />
                <input type="number" hidden value="1" name="quantity" />

                <button class="btn"><i class="lni lni-cart"></i>
                    Add to
                    Cart</button>
            </form>
        </div>
    </div>
    <div class="product-info">
        <span class="category">{{ $product->category->name }}</span>
        <h4 class="title">
            <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
        </h4>
        <ul class="review">
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star"></i></li>
            <li><span>4.0 Review(s)</span></li>
        </ul>
        <div class="price">
            <span>{{ $product->price }}</span>
            @if ($product->compare_price)
                <span class="discount-price">{{ $product->compare_price }}</span>
            @endif
        </div>
    </div>
</div>
