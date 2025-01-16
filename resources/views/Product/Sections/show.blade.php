@include('Layout.header')
<!-- hero section -->
<section>
    @include('Layout.navbar')

<div class="box-border flex justify-start items-center flex-col product-information-page">
    <div class="w-11/12 md:w-4/5 m-auto pt-8 pb-24 mx-[5px]">
      <div class="mt-32">
        {{-- <a href="{{ url()->previous() }}" class="flex items-center justify-center rounded-lg underline mb-2 border border-solid border-[2px] border-gray-400 p-2 ">
          <img class="w-[20px] h-[20px]" src="{{ url('storage/icons/iconright.svg') }}" alt="">
          {{ app()->getLocale() == 'en' ? 'Back' : 'الرجوع' }}
        </a> --}}
        <div class="box-border grid md:grid-cols-[repeat(auto-fill,minmax(400px,1fr))] grid-cols-[repeat(auto-fill,minmax(300px,1fr))] gap-[30px] mb-[40px]">
            @foreach ($product->images as $image)
            <img src="{{ url("storage/".$image->path) }}" class="w-full h-auto max-w-full rounded-xl" />
            @endforeach
        </div>
        <div>
          <h2 class="main-title [font-family:Montserrat,sans-serif] text-6xl font-bold leading-[72px] uppercase text-[#333333] mt-5">
            {{ $product->name }}
          </h2>
          <p class="[font-family:Roboto,sans-serif] text-[16px] md:text-[22px] font-normal text-left leading-[30px] text-[#777777]">
            {{ $product->description }}
        </p>
        <div class="blog-section-content">
            {!! $product->content !!}
        </div>
        <div class="mt-10">
          <p class="main-title [font-family:Montserrat,sans-serif] text-[40px] font-bold leading-[48px] uppercase text-[#333333]" >
            {{ app()->getLocale() == 'en' ? 'More Products' : 'منتجات اخرى' }}
          </p>
          <div class="all-products grid grid-cols-[repeat(auto-fill,minmax(320px,1fr))] gap-[31px] box-border mt-10" >

            @foreach ($products as $productDate)
                <div class="flex justify-center items-stretch flex-col">
                    <img src="{{ url("storage/".$productDate->images()->first()->path) }}" class=" rounded-[10px]" />
                    <p class="[font-family:Montserrat,sans-serif] text-base font-semibold leading-[19px] uppercase text-[#333333] mt-4">
                      <a href="{{ url(app()->getLocale() == 'en' ? '/products/'.$productDate->slug : '/'.app()->getLocale().'/products/'.$productDate->slug) }}">{{ $productDate->name }}</a>
                    </p>
                  </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@include('Layout.footer')
