@include('Layout.header')
<!-- hero section -->
<section>
    @php

    @endphp
<!-- hero section -->
<section>
    @include('Layout.navbar')
    <!-- products -->
    <section class="products-page">
        <div class="w-11/12 sm:w-4/5 m-auto">
          <div>
            <div class="pt-8 pb-24">
              <div class="flex justify-start items-stretch flex-col box-border mt-32">
                <div>



                  @if (app()->getLocale() == 'ar')
                    <h2 class="main-title [font-family:Montserrat,sans-serif] text-6xl font-bold leading-[72px] uppercase text-[#333333] max-w-[609px]">
                        <span>اعرف اكثر </span>
                        <span>عن</span>
                        <span> منتجاتنا</span><span class="text-[#ea5212] leading-[72px]">.</span>
                    </h2>

                  @elseif (app()->getLocale() == 'en')
                   <!--? title -->
                   <h2 class="main-title [font-family:Montserrat,sans-serif] text-6xl font-bold leading-[72px] uppercase text-[#333333] max-w-[609px]">
                    <span>Browse </span>
                    <span class="text-[#ea5212]">All</span>
                    <span class="font-normal">Our</span>
                    <span> Products</span><span class="text-[#ea5212] leading-[72px]">.</span>
                  </h2>

                  @endif
                  <!--? title -->
                  {{-- <!--? fillter -->
                  <div class="btns-controllers border border-[#E8E8E8] mt-12 bg-white rounded-[999px] flex flex-row justify-center items-center w-[350px] ml-auto py-2 px-6 gap-4 mb-12">
                    <div class="flex flex-row justify-between items-center gap-[10px] ">
                      <button class="[font-family:'Open_Sans',sans-serif] box-border flex justify-center items-center h-8 px-4 bg-[#166e1d] text-white rounded-[999px] toggle-bg transition-colors duration-300" onclick="toggleButton(this)">Featured</button>
                      <button class="[font-family:'Open_Sans',sans-serif] box-border flex justify-center items-center h-8 px-4 text-black rounded-[999px] toggle-bg transition-colors duration-300" onclick="toggleButton(this)">Featured2</button>
                      <button class="[font-family:'Open_Sans',sans-serif] box-border flex justify-center items-center h-8 px-4 text-black rounded-[999px] toggle-bg transition-colors duration-300" onclick="toggleButton(this)">Featured3</button>
                    </div>
                  </div>
                  <!--? fillter --> --}}

                    {{-- Filter Section --}}
                    <div class="btns-controllers border border-[#E8E8E8] mt-12 bg-white rounded-[999px] flex flex-row justify-center items-center w-[350px] ml-auto py-2 px-6 gap-4 mb-12">
                        <div class="flex flex-row justify-between items-center gap-[10px]">
                            {{-- All Button --}}
                            <a href="{{ url()->current() }}"
                            class="btn-filter [font-family:'Open_Sans',sans-serif] box-border flex justify-center items-center h-8 px-4 rounded-[999px] toggle-bg transition-colors duration-300 {{ request('categoryId') == '' ? 'bg-[#166e1d] text-white' : 'text-[#000000]' }}">
                                {{ app()->getLocale() == 'ar' ? 'الكل' : 'All'}}
                            </a>

                            {{-- Dynamic Category Buttons --}}
                            @foreach ($productCategories as $productCategory)
                                <a href="{{ request()->fullUrlWithQuery(['categoryId' => $productCategory->id, 'page' => null]) }}"
                                class="[font-family:'Open_Sans',sans-serif] box-border flex justify-center items-center h-8 px-4 rounded-[999px] toggle-bg transition-colors duration-300 {{ request('categoryId') == $productCategory->id ? 'bg-[#166e1d] text-white' : 'text-black' }}">
                                    {{ $productCategory->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="gap-8 mt-6 px-1">
                      <div class="all-products grid grid-cols-[repeat(auto-fill,minmax(340px,1fr))] md:grid-cols-[repeat(auto-fill,minmax(380px,1fr))] gap-[31px]">
                        @foreach ($products as $product)
                        <div class="product-box flex justify-center items-stretch flex-col rounded-[10px] cursor-pointer transition-shadow duration-300 overflow-hidden">
                            <div class="h-[275px] overflow-hidden rounded-[10px]">
                              <img class=" w-full h-full object-cover  transition-transform duration-300 focus:scale-[1.5] hover:scale-[1.3]" src="{{ url("storage/".$product->images()->first()->path) }}" />
                            </div>
                            <p class="[font-family:Montserrat,sans-serif] font-semibold uppercase text-[#333333] mt-4">
                              @if (app()->getLocale() == 'en')
                                  <a href="{{ url()->current()}}/{{ $product->slug }}">{{ $product->name }}</a>
                              @elseif (app()->getLocale() == 'ar')
                                  <a href="{{ url()->current()}}/{{ $product->slug }}">{{ $product->name }}</a>
                              @endif
                            </p>
                          </div>

                        @endforeach

                      </div>
                    </div>
                  </div>

                  {{-- Pagination Section --}}
@if ($products->hasPages())
<nav class="pagination-container flex items-center justify-center space-x-2 mt-8">
    {{-- Previous Page Link --}}
    @if ($products->onFirstPage())
        <span class="disabled text-gray-400">❮</span>
    @else
        <a href="{{ $products->previousPageUrl() }}" class="pagination-link text-blue-500">❮</a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
        @if ($page == $products->currentPage())
            <span class="active bg-[#e8f1e8] [font-family:Montserrat,sans-serif] text-sm font-semibold leading-[17px] text-[#166e1d] inline-flex items-center justify-center h-8 box-border  px-[11px] py-0 rounded-sm border-[none]">{{ $page }}</span>
        @else
            <a href="{{ $url }}" class="pagination-link text-sm font-semibold leading-[17px] text-[#333333]">{{ $page }}</a>
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($products->hasMorePages())
        <a href="{{ $products->nextPageUrl() }}" class="text-dark-500">❯</a>
    @else
        <span class="disabled text-gray-400">❯</span>
    @endif
</nav>
@endif

</section>
{{-- @include('Home.Sections.aboutUs', [
    'aboutUsSection' => $aboutUsSection,
    'aboutUsSectionImages' => $aboutUsSectionImages,
]) --}}


@include('Layout.footer')
