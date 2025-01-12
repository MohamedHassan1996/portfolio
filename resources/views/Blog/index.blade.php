@include('Layout.header')
<!-- hero section -->
<!-- blogs page -->
<section>
    @include('Layout.navbar')

    <div class="blog-page">
      <div class="blog-container flex justify-start flex-col w-4/5 m-auto">
        <div class="pt-8 pb-24">
          <div class="flex justify-start flex-col mt-32">
            <div>
              <!-- main constant title -->
              @if (app()->getLocale() == 'en')
              <p class="main-title [font-family:Montserrat,sans-serif] text-6xl font-bold leading-[72px] uppercase text-[#333333] max-w-[845px] box-border">
                <span>Professional Insights: </span>
                <span class="font-normal">News</span>
                <span></span>
                <span class="text-[#ea5212]">&amp;</span>
                <span> Articles<span class="text-[#ea5212]">.</span></span>
              </p>
              @elseif (app()->getLocale() == 'ar')
              <p class="main-title [font-family:Montserrat,sans-serif] text-6xl font-bold leading-[72px] uppercase text-[#333333] max-w-[845px] box-border"></p>
                <span>مقالات</span>
                <span class="text-[#ea5212]">.</span>
              </p>
              @endif
              <!-- blogs content -->
              <div class="blog-content-section flex justify-start items-start gap-[20px] flex-row box-border w-full mt-12">
              {{-- <div class="flex flex-col gap-[20px] w-full md:w-[70%] h-[602px]">
                @foreach ($blogs as $blog)
                <div class="bg-[white] box-border relative flex justify-start flex-col rounded-xl border-2 border-solid border-[#e8e8e8]">
                    <img src="{{ url("storage/$blog->thumbnail") }}" class=" rounded-lg" alt="image1" loading="lazy">
                    <div class="bg-cover bg-no-repeat  box-border flex justify-start items-center flex-col pt-4">
                        <div class="bg-[white] absolute top-[16px] right-[16px] box-border flex justify-start items-center flex-col w-[60px] py-2 rounded-lg">
                          <p class="[font-family:Montserrat,sans-serif] text-2xl font-semibold leading-[29px] text-[#333333]">{{ $blog->created_at->format('d') }}</p>
                          <p class="[font-family:Roboto,sans-serif] text-sm font-normal text-[#333333]">{{ $blog->created_at->format('M') }}</p>
                        </div>
                    </div>
                    <div class="box-border flex justify-center items-stretch flex-col pt-11 pb-6 px-[23px]">
                      <p class="[font-family:Montserrat,sans-serif] text-[35px] font-semibold leading-[42px] text-[#333333] p-0 m-0">
                        {{ $blog->title }}
                      </p>
                      <p class="[font-family:Roboto,sans-serif] text-lg font-normal leading-[21.5px] text-[#777777] mt-[15.5px] m-0 p-0" >
                        {{ $blog->description }}
                      </p>

                        @if(app()->getLocale() == 'en')
                            <a href="{{ url()->current()}}/{{ $blog->slug }}" class="[font-family:Roboto,sans-serif] cursor-pointer text-lg font-normal text-[#166e1d] mt-3">
                                read me
                            </a>
                        @elseif(app()->getLocale() == 'ar')
                        <a href="{{ url()->current()}}/{{ $blog->slug }}" class="[font-family:Roboto,sans-serif] cursor-pointer text-lg font-normal text-[#166e1d] mt-3">
                            المزيد
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
              </div> --}}


              <div class="flex flex-col gap-[20px] w-full md:w-[70%] h-[602px]">
                @foreach ($blogs as $blog)
                <div class="bg-[white] box-border relative flex justify-start flex-col rounded-xl border-2 border-solid border-[#e8e8e8]">
                    <img src="{{ url("storage/$blog->thumbnail") }}" class="w-full h-[300px] rounded-lg" alt="image1" loading="lazy">
                    <div class="bg-cover bg-no-repeat  box-border flex justify-start items-center flex-col pt-4">
                        <div class="bg-[white] absolute top-[16px] right-[16px] box-border flex justify-start items-center flex-col w-[60px] py-2 rounded-lg">
                          <p class="[font-family:Montserrat,sans-serif] text-2xl font-semibold leading-[29px] text-[#333333]">{{ $blog->created_at->format('d') }}</p>
                          <p class="[font-family:Roboto,sans-serif] text-sm font-normal text-[#333333]">{{ $blog->created_at->format('M') }}</p>
                        </div>
                    </div>
                    <div class="box-border flex justify-center items-stretch flex-col pt-11 pb-6 px-[23px]">
                      <h2 class="[font-family:Montserrat,sans-serif] text-[35px] font-semibold leading-[42px] text-[#333333] p-0 m-0 w-full sm:w-[600px] sm-max-w-[650px]">
                        {{ $blog->title }}
                      </h2>
                      <p class="[font-family:Roboto,sans-serif] text-lg font-normal leading-[21.5px] text-[#777777] mt-[15.5px] m-0 p-0" >
                        {{ $blog->description }}
                      </p>
                      @if(app()->getLocale() == 'en')
                            <a href="{{ url()->current()}}/{{ $blog->slug }}" class="[font-family:Roboto,sans-serif] cursor-pointer text-lg font-normal text-[#166e1d] mt-3">
                                read me
                            </a>
                        @elseif(app()->getLocale() == 'ar')
                        <a href="{{ url()->current()}}/{{ $blog->slug }}" class="[font-family:Roboto,sans-serif] cursor-pointer text-lg font-normal text-[#166e1d] mt-3">
                            المزيد
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
              </div>

                <!-- right controles status & Latest -->
                <div class="blogs-Categories border w-full md:w-[30%] bg-[white] box-border flex justify-start items-stretch flex-col gap-[31px] pt-[39px] px-[23px] rounded-lg border-solid border-[#e8e8e8]">
                  <div class="">
                    <!-- Input Component is detected here -->
                    <div  class="border bg-[#fbfcf8] h-[50px] box-border flex flex-row items-center [justify-content:start] rounded-sm border-solid border-[#333333]">
                      <input placeholder="Search" type="text"
                        class="w-full [font-family:Roboto,sans-serif] text-base font-normal bg-transparent [outline:none] box-border ml-3 border-[none] text-[#8e8e8e]"
                      />
                      <div class="w-6 h-6 text-[#333333] flex mr-[13px] my-[13px]">
                        <img src="{{ url('public/storage/icons/search.png') }}" alt="">
                      </div>
                    </div>
                  </div>
                  <div class="">
                    <p class="[font-family:Montserrat,sans-serif] text-[17px] font-semibold leading-[20.5px] uppercase text-[#333333]">
                      @if(app()->getLocale() == 'en')
                      Categories
                      @elseif (app()->getLocale() == 'ar')
                      التصنيفات
                      @endif
                    </p>
                    <div class="flex justify-center items-stretch flex-col gap-4 box-border mt-4"
                    >
                    @foreach ($blogCategories as $blogCategory)
                    <div class="rounded bg-[rgba(51,51,51,0.04)] box-border flex justify-between items-center flex-row gap-2 h-[43px] px-[15px]">
                        <p class="[font-family:Roboto,sans-serif] text-lg font-medium text-[#333333] m-0 p-0">
                          {{ $blogCategory->name }}
                        </p>
                        <p class="[font-family:Roboto,sans-serif] text-lg font-medium text-[#333333] m-0 p-0">
                          {{ $blogCategory->blogs_count }}
                        </p>
                      </div>
                    @endforeach

                    </div>
                  </div>
                  <div class="">
                    <p class="[font-family:Montserrat,sans-serif] text-[17px] font-semibold leading-[20.5px] uppercase text-[#333333] m-0 p-0">
                      @if(app()->getLocale() == 'en')
                      Latest posts
                      @elseif(app()->getLocale()=='ar')
                      اخر الاخبار
                      @endif
                    </p>
                    <div class="w-[100.00%] box-border my-4">
                      @foreach ($blogs as $blog)
                      <div class="rounded bg-[rgba(51,51,51,0.04)] gap-4 box-border flex justify-start items-center flex-row w-[100.00%] h-[85px] pl-2 pr-[7px] first:mt-0 mt-[16.00px]">
                        <img class="rounded h-[69px] max-w-[initial] object-cover w-[85px] box-border block border-[none]" src="{{ url("storage/$blog->thumbnail") }}" />
                        <div class="grow-0 shrink basis-auto py-2">
                          <div class="bg-[rgba(51,51,51,0.04)] box-border flex justify-start items-center flex-col w-[35px] rounded-[999px]">
                            <p class="[font-family:Roboto,sans-serif] text-[8px] font-normal text-[#333333] m-0 p-0">
                              {{$blog->blogCategory->name}}
                            </p>
                          </div>
                          <p class="[font-family:Roboto,sans-serif] text-lg font-medium leading-[27px] text-[#333333] w-[100.00%] mt-[3px] m-0 p-0">
                            {{$blog->title}}
                          </p>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                <!-- right controles status & Latest -->
              </div>
            </div>
            {{-- <!-- pagination -->
            <div class="rounded border bg-[white] box-border flex justify-start items-center flex-row mt-24 border-solid border-[#e8e8e8]">
              <div class="w-8 h-8 text-[#091e42] flex ">
                <img src="./public/icons/iconright.svg" alt="">
              </div>
              <div class="flex justify-start items-center flex-row ">
                <span class="bg-[#e8f1e8] [font-family:Montserrat,sans-serif] text-sm font-semibold leading-[17px] text-[#166e1d] inline-flex items-center justify-center h-8 box-border  px-[11px] py-0 rounded-sm border-[none]">1</span>
                <div class="flex justify-start items-center flex-row gap-[22px] ml-[11px]">
                  <p class="text-sm font-semibold leading-[17px] text-[#333333]">2</p>
                  <p class="text-sm font-semibold leading-[17px] text-[#333333]">3</p>
                  <p class="text-sm font-semibold leading-[17px] text-[#333333]">4</p>
                  <p class="text-sm font-semibold leading-[17px] text-[#333333]">5</p>
                  <p class="text-sm font-normal text-[#172b4d]">...</p>
                  <p class="text-sm font-semibold leading-[17px] text-[#333333]">20</p>
                </div>
              </div>
              <div class="w-8 h-8 text-[#333333] flex  ml-[11px]">
                <img src="./public/icons/iconl.svg" alt="">
              </div>
            </div>
            <!-- pagination --> --}}
                              {{-- Pagination Section --}}
@if ($blogs->hasPages())
<nav class="pagination-container flex items-center justify-center space-x-2 mt-8">
    {{-- Previous Page Link --}}
    @if ($blogs->onFirstPage())
        <span class="disabled text-gray-400">❮</span>
    @else
        <a href="{{ $blogs->previousPageUrl() }}" class="pagination-link text-blue-500">❮</a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
        @if ($page == $blogs->currentPage())
            <span class="active bg-[#e8f1e8] [font-family:Montserrat,sans-serif] text-sm font-semibold leading-[17px] text-[#166e1d] inline-flex items-center justify-center h-8 box-border  px-[11px] py-0 rounded-sm border-[none]">{{ $page }}</span>
        @else
            <a href="{{ $url }}" class="pagination-link text-sm font-semibold leading-[17px] text-[#333333]">{{ $page }}</a>
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($blogs->hasMorePages())
        <a href="{{ $blogs->nextPageUrl() }}" class="text-dark-500">❯</a>
    @else
        <span class="disabled text-gray-400">❯</span>
    @endif
</nav>
@endif
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- blogs page -->
@include('Layout.footer')
