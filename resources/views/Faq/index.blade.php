@include('Layout.header')
<!-- hero section -->
<section>
    @php
        //$data = $faqPage->sections;
    @endphp
<!-- hero section -->
<section>
    @include('Layout.navbar')
    <div class="FAQ">
        <div class="w-11/12 sm:w-4/5 m-auto flex justify-start items-stretch flex-col pt-40 pb-24">
            @if (app()->getLocale() == 'en')
            <p class="main-title [font-family:Montserrat,sans-serif] text-6xl font-bold  leading-[72px] uppercase text-[#333333] max-w-[954px]"><span>Key </span>
                <span class="text-[#ea5212]  leading-[72px] uppercase">Questions</span>
                <span class="[font-family:Montserrat,sans-serif] text-6xl font-normal text-[#ea5212]  leading-[72px] uppercase"> </span>
                <span>That Matter to </span>
                <span class="font-normal">You</span><span class="font-bold text-[#ea5212]">.</span>
              </p>
            @elseif (app()->getLocale() == 'ar')
            <p class="main-title [font-family:Montserrat,sans-serif] text-6xl font-bold  leading-[72px] uppercase text-[#333333] max-w-[954px]"><span>الأسئلة</span>
                <span class="text-[#ea5212]  leading-[72px] uppercase">الاكثر شيوعا</span>
            </p>

            @endif
          <div class="flex justify-start items-center flex-col grow-0 shrink-0 basis-auto mt-12">
            <div class="w-[320px] md:w-[753px] sm:[753] box-border">

              <div id="faq-container" class="flex flex-col gap-4">
                @foreach($faqs as $faq)
                <div class="faq-item border border-[#e0e0e0] bg-white rounded-[8px]">
                    <div class="faq-question flex justify-between items-center p-4 cursor-pointer text-[Montserrat,sans-serif] text-xl font-semibold text-[#333333]" onclick="toggleAnswer(this)">
                      <p>{{ $faq->question }}</p>
                      <img src="{{ url('storage/icons/plus.svg') }}" class="icon w-6 h-6" alt="plus icon">
                    </div>
                    <div class="faq-answer hidden text-[Open_Sans,sans-serif] text-[17px] font-normal  leading-[23px] text-[#8e8e8e] p-4">
                      <p>{{ $faq->answer }}</p>
                    </div>
                  </div>
                @endforeach


              </div>


            </div>
          </div>
        </div>
      </div>

</section>
@include('Layout.footer')
