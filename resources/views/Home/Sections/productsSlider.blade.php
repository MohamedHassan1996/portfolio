<!-- products -->
<section class="flex justify-start items-center flex-col ProductsSection py-[70px]">
    <div class="w-11/12 md:w-[80%] m-auto">
      <div>
        <h3 class="[font-family:Montserrat,sans-serif] text-[17px] font-semibold leading-[20.5px] text-[#458B4A]">
          {{ $productsSection->content[0]['subTitle'] }}<span class="text-[#EA5212]">.</span>
        </h3>
        <h1 class="main-title [font-family:Montserrat,sans-serif] text-[64px] leading-[76px] font-bold uppercase text-[#fbfcf8] max-w-[60%] box-border mt-2">
          <span >{{ $productsSection->content[0]['heading'] }}</span><span class="text-[#ee7541]">.</span>
        </h1>
      </div>
      <div class="swiper mySwiper">
        <div class="swiper-wrapper flex justify-center items-center gap-8 mt-10">
          @foreach ($products as $product)
          <div class="swiper-slide w-[180px] h-[full] flex-none">
            <img src="{{ url("public/storage/".$product->images()->first()->path) }}" class="object-cover w-full h-full rounded-xl" />
            <a href="{{ app()->getLocale() == 'en' ? url('products/'.$product->slug) : url('ar/المنتجات/'.$product->slug) }}" class="font-montserrat text-[17px] font-semibold uppercase underline text-[#fbfcf8] mt-2 text-start">
              {{ $product->name }}
            </a>
          </div>
          @endforeach
        </div>
        <!-- Navigation Buttons -->
        <div class="flex justify-center gap-4 mt-5 slider-navigation">
          <button class="next-btn bg-[#EA5212] p-2 rounded transform rotate-180">
            <img src="{{ url('public/storage/icons/iconl.svg') }}" alt="Previous" width="20" />
          </button>
          <button class="prev-btn bg-[#EA5212] p-2 rounded">
            <img src="{{ url('public/storage/icons/iconl.svg') }}" alt="Next" width="20" />
          </button>
        </div>
        <!-- <div class="swiper-pagination"></div> -->
      </div>

    </div>
  </section>
