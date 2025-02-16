@include('Layout.header')
<!-- hero section -->
<!-- blogs page -->
<section>
    @include('Layout.navbar')

        <!-- page content -->
        <section class="box-border flex justify-start items-center flex-col bg-[#fbfcf8]">
          <div class="careers-boxes w-11/12 sm:w-4/5 m-auto box-border pt-8 pb-24">
            <div class="w-[100.00%] box-border mt-32">
              <p class="main-title [font-family:Montserrat,sans-serif] text-6xl font-bold leading-[72px] uppercase text-[#333333]">
                @if (app()->getLocale() == 'en')
                    <span>Join </span>
                    <span class="font-normal">Our</span>
                    <span> Team: </span>
                    <span class="text-[#ea5212]">Build</span>
                    <span> the Future of Healthcare</span>
                    <span class="text-[#ea5212]">.</span>
                @elseif (app()->getLocale() == 'ar')
                    <span>انضم </span>
                    <span class="font-normal">لفريقنا</span>
                    <span class="text-[#ea5212]">لبناء</span>
                    <span>مستقبل افضل </span>
                    <span class="text-[#ea5212]">.</span>
                @endif
              </p>
              @foreach ($careers as $career)
              <div class="grid gap-8 mt-12 justify-center grid-cols-[repeat(auto-fill,minmax(300px,1fr))] md:grid-cols-[repeat(auto-fill,minmax(400px,1fr))]">
                <a href="{{ url()->current()}}/{{ $career->slug }}" class="career-box-content cursor-pointer border bg-[white] box-border flex justify-center items-stretch flex-col gap-4 max-w-[600px] px-[31px] py-8 rounded-lg border-solid border-[#e8e8e8]"
                >
                  <p
                    class="[font-family:Montserrat,sans-serif] text-[35px] font-semibold leading-[42px] uppercase text-[#333333]"
                  >
                    {{ $career->title }}
                  </p>
                  <p
                    class="[font-family:'Open_Sans',sans-serif] text-[17px] font-normal text-left leading-[23px] text-[#8e8e8e]"
                  >
                    Qui veritatis quo non nostrum eveniet consequatur animi
                    voluptas<br />
                    etQui veritatis quo non nostrum eveniet consequaturQui veritatis
                    quo non nostrum eveniet consequatur animi
                  </p>
                  <div
                    class="flex justify-start items-center flex-row grow-0 shrink-0 basis-auto"
                  >
                    <button
                      class="bg-[rgba(51,51,51,0.04)] [font-family:Roboto,sans-serif] text-base font-normal text-[#333333] cursor-pointer min-w-[109px] h-8 w-[109px] rounded-[999px] border-[none]"
                    >
                      Full time
                    </button>
                    <button
                      class="bg-[rgba(51,51,51,0.04)] [font-family:Roboto,sans-serif] text-base font-normal text-[#333333] cursor-pointer min-w-[149px] h-8 w-[149px] ml-4 rounded-[999px] border-[none]"
                    >
                      +2 Experience
                    </button>
                  </div>
                </a>
              </div>
              @endforeach
            </div>
          </div>
        </section>

        <script src="./scripts/main.js"></script>
      </body>
    </html>  </section>
  <!-- blogs page -->
@include('Layout.footer')
