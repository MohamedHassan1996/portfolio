@include('Layout.header')
<!-- hero section -->
<!-- blogs page -->
<section>
    @include('Layout.navbar')
    <div class="blog-information py-[150px]">
        <div class="w-11/12 md:w-4/5 m-auto">
          <!-- hero blog details page -->
          <div class="hero relative">
            <img src="{{ url("storage/".$blog->thumbnail) }}" class="w-full h-auto max-h-[480px] rounded-[15px] object-cover" alt="hero image" loading="lazy" />
            <div class="bg-[white] absolute top-[16px] right-[16px] box-border flex justify-start items-center flex-col w-[60px] py-2 rounded-lg">
              <p class="[font-family:Montserrat,sans-serif] text-2xl font-semibold leading-[29px] text-[#333333]">
                {{ $blog->created_at->format('d') }}
              </p>
              <p
                class="[font-family:Roboto,sans-serif] text-sm font-normal text-[#333333]"
              >
                {{ $blog->created_at->format('M') }}
              </p>
            </div>
          </div>

          <div class="mt-[40px] flex flex-col-reverse md:flex-row justify-between gap-[32px]">

            <div class="information md:w-[80%]">
              <p class="main-title [font-family:Montserrat,sans-serif] text-6xl font-bold leading-[72px] uppercase text-[#333333]">{{ $blog->title }}</p>
              <p class="[font-family:Roboto,sans-serif] text-xl font-normal leading-[30px] text-[#777777] w-full box-border mt-10 ">
               {{ $blog->description }}
              </p>
              <div class="blog-section-content">
                {!! $blog->content !!}
              </div>
            </div>

            <!-- right controles status & Latest -->
            <div  class="border bg-[white] h-[fit-content] box-border flex justify-start items-stretch flex-col gap-[31px] pt-[39px] px-[10px] rounded-lg border-solid border-[#e8e8e8]">
              <div>
                <!-- Input Component is detected here -->
                <div class="border bg-[#fbfcf8] h-[50px] box-border flex flex-row items-center [justify-content:start] rounded-sm border-solid border-[#333333]">
                  <input
                    placeholder="Search"
                    type="text"
                    class="w-full [font-family:Roboto,sans-serif] text-base font-normal bg-transparent [outline:none] box-border ml-3 border-[none] text-[#8e8e8e]"
                  />
                  <div class="w-6 h-6 text-[#333333] flex mr-[13px] my-[13px]">
                    <img src="{{ url('public/storage/icons/search.png') }}" alt="" />
                  </div>
                </div>
              </div>
              <div class="">
                <p
                  class="[font-family:Montserrat,sans-serif] text-[17px] font-semibold leading-[20.5px] uppercase text-[#333333]"
                >
                  {{ app()->getLocale() == 'en' ? 'Categories' : 'التصنيفات' }}
                </p>
                <div
                  class="flex justify-center items-stretch flex-col gap-4 box-border mt-4"
                >
                  @foreach ($blogCategories as $blogCategory)
                  <div
                    class="rounded bg-[rgba(51,51,51,0.04)] box-border flex justify-between items-center flex-row gap-2 h-[43px] px-[15px]"
                  >
                    <p
                      class="[font-family:Roboto,sans-serif] text-lg font-medium text-[#333333] m-0 p-0"
                    >
                      {{ $blogCategory->name }}
                    </p>
                    <p
                      class="[font-family:Roboto,sans-serif] text-lg font-medium text-[#333333] m-0 p-0"
                    >
                      {{ $blogCategory->blogs_count }}
                    </p>
                  </div>
                  @endforeach
                </div>
              </div>
              <div class="">
                @if (count($latestBlogs) > 0)
                    <p
                    class="[font-family:Montserrat,sans-serif] text-[17px] font-semibold leading-[20.5px] uppercase text-[#333333] m-0 p-0"
                >
                    {{ app()->getLocale() == 'en' ? 'Latest News' : 'اخر الاخبار' }}
                </p>
                @endif
                <div class="w-[100.00%] box-border my-4">
                  @foreach ($latestBlogs as $latestBlog)
                  <div class="rounded bg-[rgba(51,51,51,0.04)] box-border flex justify-center items-center flex-row w-[100.00%] h-[100px] pl-2 pr-[7px] first:mt-0 mt-[16.00px]">
                    <img
                      class="rounded h-[69px] max-w-[initial] object-cover w-[85px] box-border block border-[none]"
                      src="{{ url("public/storage/$latestBlog->thumbnail") }}"
                    />
                    <div class="grow-0 shrink basis-auto ml-[7px] py-2">
                      <div
                        class="bg-[rgba(51,51,51,0.04)] box-border flex justify-start items-center flex-col w-[35px] rounded-[999px]"
                      >
                        <p
                          class="[font-family:Roboto,sans-serif] text-[8px] font-normal text-[#333333] m-0 p-0"
                        >
                          {{ $latestBlog->blogCategory->name }}
                        </p>
                      </div>
                      <p
                        class="[font-family:Roboto,sans-serif] text-lg font-medium text-left leading-[27px] text-[#333333] w-[100.00%] mt-[3px] m-0 p-0"
                      >
                        {{ $latestBlog->title }}
                      </p>
                    </div>
                  </div>

                  @endforeach
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

</section>
@include('Layout.footer')
