@extends('store.layout')

@section('content')
  <main class="container main">
    <section class="hero">
      <aside class="hero__cats" aria-label="Categories">
        <h3 class="hero__cats-title"><span data-icon="grid"></span> All Categories</h3>
        <ul data-sidebar-cats></ul>
      </aside>

      <div class="slider" data-slider>
        <div class="slider__track" data-slider-track></div>
        <button class="slider__arrow slider__arrow--prev" data-slider-prev aria-label="Previous slide"><span data-icon="chevron-left"></span></button>
        <button class="slider__arrow slider__arrow--next" data-slider-next aria-label="Next slide"><span data-icon="chevron-right"></span></button>
        <div class="slider__dots" data-slider-dots></div>
      </div>
    </section>

    <section class="trust">
      <div class="trust__item"><span data-icon="shield"></span><p>Safe Payments</p></div>
      <div class="trust__item"><span data-icon="truck"></span><p>Nationwide Delivery</p></div>
      <div class="trust__item"><span data-icon="return"></span><p>Free &amp; Easy Return</p></div>
      <div class="trust__item"><span data-icon="tag"></span><p>Best Price Guaranteed</p></div>
      <div class="trust__item"><span data-icon="badge"></span><p>100% Authentic Products</p></div>
      <div class="trust__item"><span data-icon="check"></span><p>Verified</p></div>
    </section>

    <section class="chips-wrap" id="products">
      <div class="chips" data-chips></div>
    </section>

    <div data-sections></div>
  </main>
@endsection
