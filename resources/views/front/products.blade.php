@extends('front.layout.app')

@section('title')
Product
@endsection

@section('main')
<section class="main">
    <section class="theme-container py-lg-5 py-3">
        <section class="product-head-section">
            <h2 class="theme-heading">Coughs, Cold & Flu Medicines</h2>
            <p class="theme-paragraph mt-lg-4 mt-3">Lorem Ipsum is simply dummy text of the printing and typesetting
                industry.
                Lorem
                Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                but also the leap into electronic typesetting, remaining essentially unchanged. Lorem Ipsum is simply
                dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type
                specimen book. </p>
        </section>
        <div class="product-container">
            <aside class="product-filters" aria-label="Product Filters">
                <div class="product-filters-header">
                    <span>Filter</span>
                    <a href="#" class="product-clear" id="product-clear-filters" tabindex="0">× Clear Filters</a>
                </div>

                <!-- Brand Filter -->
                <details class="product-filter-group" open>
                    <summary>
                        Brand
                        <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1.646 5.646a.5.5 0 0 1 .708 0L8 11.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </summary>
                    <div class="product-filter-list" role="group" aria-labelledby="filter-brand-label">
                        @php
                            // Group products by brand name and count them
                            $brandCounts = $products->groupBy('brand.name')->map->count();
                        @endphp
                    
                        @foreach ($brandCounts as $brandName => $count)
                            <label>
                                <input type="checkbox" name="brand" value="{{ $brandName }}" /> 
                                {{ $brandName }} ({{ $count }})
                            </label>
                        @endforeach
                    </div>

                </details>

                <!-- Format Filter -->
                <details class="product-filter-group">
                    <summary>
                        Format
                        <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1.646 5.646a.5.5 0 0 1 .708 0L8 11.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </summary>
                    <div class="product-filter-list" role="group" aria-labelledby="filter-format-label">
                        <label><input type="checkbox" name="format" value="Drops" checked /> Drops</label>
                        <label><input type="checkbox" name="format" value="Liquid" /> Liquid</label>
                        <label><input type="checkbox" name="format" value="Lozenges" /> Lozenges</label>
                        <label><input type="checkbox" name="format" value="Spray" /> Spray</label>
                        <label><input type="checkbox" name="format" value="Tablets & Capsules" /> Tablets &
                            Capsules</label>
                    </div>
                </details>

                <!-- Product Filter -->
                <details class="product-filter-group">
                    <summary>
                        Product
                        <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1.646 5.646a.5.5 0 0 1 .708 0L8 11.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </summary>
                    <div class="product-filter-list" role="group" aria-labelledby="filter-product-label">
                        <label><input type="checkbox" name="product" value="Cough" checked /> Cough</label>
                        <label><input type="checkbox" name="product" value="Herbal Remedies" /> Herbal Remedies</label>
                    </div>
                </details>

                <!-- Size Filter -->
                <details class="product-filter-group">
                    <summary>
                        Size
                        <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1.646 5.646a.5.5 0 0 1 .708 0L8 11.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </summary>
                    <div class="product-filter-list" role="group" aria-labelledby="filter-size-label">
                        @php
                            // Group products by pack_size and count them
                            $sizeCounts = $products->groupBy('pack_size')->map->count();
                        @endphp
                    
                        @foreach ($sizeCounts as $size => $count)
                            <label>
                                <input type="checkbox" name="size" value="{{ $size }}" /> 
                                {{ $size }} ({{ $count }})
                            </label>
                        @endforeach
                    </div>

                </details>

                <!-- Price Filter -->
                <details class="product-filter-group">
                    <summary>
                        Price
                        <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1.646 5.646a.5.5 0 0 1 .708 0L8 11.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </summary>
                    <div class="product-filter-price" role="group" aria-labelledby="filter-price-label">
                        <div class="range-container">
                            <div class="slider-track" id="sliderTrack"></div>
                            <input type="range" id="minPrice" min="0" max="500" value="200" step="10">
                            <input type="range" id="maxPrice" min="0" max="500" value="400" step="10">
                        </div>
                        <div class="product-slider-inputs">
                            <span>£0</span>
                            <span id="priceOutput">£200 - £400</span>
                            <span>£500</span>
                        </div>
                    </div>
                </details>
            </aside>
            <section class="product-maincontent" aria-label="Products and Sorting">
                <div class="product-top-controls">
                    <label>
                        <select class="product-select" aria-label="Sort products by">
                            <option value="relevance">Sort by: Relevance</option>
                            <option value="price-asc">Price: Low to High</option>
                            <option value="price-desc">Price: High to Low</option>
                        </select>
                    </label>

                    <label>
                        <select class="product-select" aria-label="Show number of products">
                            <option value="60">Show: 60</option>
                            <option value="30">Show: 30</option>
                            <option value="90">Show: 90</option>
                        </select>
                    </label>
                </div>

                <div class="product-grid" aria-live="polite" aria-relevant="additions removals" aria-atomic="true">
                    <!-- Product cards -->
                    @foreach($products as $product)
                    <article class="product-card" tabindex="0"
                        aria-label="{{ $product->name }}">
                        <a  href="product-single.html" class="product-image-container">
                            <img src="{{ asset('assets/front/images/products/'.$product->thumbnail) }}"
                                alt="Brown glass bottle of sugar levels product with green leaves and wood base" />
                        </a>
                        <div class="product-info">
                            <a href="product-single.html" class="product-name">{{ $product->name }}</a>
                            <div class="product-info-prices">
                                <span class="product-price-old">£{{ $product->old_price }}</span>
                                <span class="product-price-current">£{{ $product->sale_price }}</span>
                            </div>
                            <a href="product-single.html" class="theme-btn-dark product-btn" tabindex="0">View Product</a>
                        </div>
                    </article>
                    @endforeach
                </div>
                <div class="load-more-btn-section my-lg-5 my-0">
                    <button class="theme-btn-dark load-more-btn" tabindex="0">Load More</button>
                </div>
            </section>
        </div>
    </section>
    </section>
@endsection