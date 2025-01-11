  <!-- news -->
  <section class="w-11/12 md:w-4/5 m-auto flex justify-center items-stretch flex-col box-border py-24">
    <div>
      <span class="[font-family:Montserrat,sans-serif] font-semibold text-[17px] text-[#166E1D]">{{ $blogSection->content[0]['subTitle'] }}
      </span>
      <p class="main-title [font-family:Montserrat,sans-serif] text-[64px] font-bold leading-[77px] uppercase text-[#333333] mt-2">
        {{ $blogSection->content[0]['heading'] }}
      </p>
    </div>
    <div  class="grid grid-cols-[repeat(auto-fill,minmax(300px,1fr))] md:grid-cols-[repeat(auto-fill,minmax(350px,1fr))] gap-[29.5px] mt-10">
        @foreach($blogs as $blog)
        <div class="bg-[rgba(51,51,51,0.04)] max-h-[500px]  relative box-border flex justify-start items-stretch flex-col rounded-lg">
            <div class="box-border flex justify-start items-stretch flex-col rounded-lg h-[300px]">
              <img src="{{ url("public/storage/".$blog->thumbnail) }}" class="h-full w-full" alt="" loading="lazy" />
              <div class="bg-[white] absolute top-3 right-3 box-border flex justify-start items-center flex-col px-2 rounded-lg">
                <p class="[font-family:Montserrat,sans-serif] text-2xl font-semibold text-[#333333] -mb-2">{{ $blog->created_at->format('d') }}</p>
                <p class="[font-family:Roboto,sans-serif] text-sm font-normal text-[#333333]">{{ $blog->created_at->format('M') }}</p>
              </div>
            </div>
            <div class="box-border grow-0 shrink-0 basis-auto pt-[21.5px] pb-[14.5px] px-[23px]">
              <h2 class="title [font-family:Montserrat,sans-serif] text-[32px] font-semibold leading-[38px] text-[#333333] mb-3">
                {{ $blog->title }}
              </h2>
              <p class="description [font-family:Roboto,sans-serif] text-lg font-normal leading-[21.5px] text-[#8e8e8e] mb-4">
                {{ $blog->description }}
              </p>
              <a href="{{ app()->getLocale() == 'en' ? url('/') . '/blog/' . $blog->slug : url('/') . '/' . app()->getLocale() . '/المدونة/'  . $blog->slug }}"
                class="[font-family:Roboto,sans-serif] text-lg font-normal text-[#166e1d] mt-3 m-0 p-0"
              >
                @if(app()->getLocale() == 'en')
                Read More
                @elseif (app()->getLocale() == 'ar')
                اقرأ المزيد
                @endif
              </a>
            </div>
          </div>

      @endforeach
    </div>
  </section>
