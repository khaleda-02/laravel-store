<x-front-layout title="products">

    <section class="product-grids section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="product-grids-head">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-grid" role="tabpanel"
                                aria-labelledby="nav-grid-tab">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-lg-3 col-md-6 col-12">
                                            <x-product-card :$product />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{ $products->withQueryString()->links() }}

</x-front-layout>
