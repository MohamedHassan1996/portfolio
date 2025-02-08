<!-- why us -->
<section class="w-11/12 md:w-4/5 m-auto whyUs pt-[100px] flex justify-between pb-[150px]">
    <div class="sm:w-[600px]">
      <h3 class="text-[#166E1D] font-[500] text-[]">
        {{ $whyUsSection->content[0]['subTitle'] }}
        @if (app()->getLocale() == 'ar')
            <span class="text-[#EA5212]">؟</span>
        @else
            <span class="text-[#EA5212]">?</span>
        @endif
      </h3>
      <h2
        class="main-title [font-family:Montserrat,sans-serif] mb-[24px] text-[64px] leading-[70px] font-bold uppercase text-[#333333] mt-2"
      >
        {{ $whyUsSection->content[0]['heading'] }}
      </h2>
      <p class="w-[90%] text-[#A4A4A4]">
        {{ $whyUsSection->content[0]['description'] }}
      </p>
    </div>
    <div class="h-[323px] relative">
      <div class="realative w-full h-full">
        <img
          src="{{ url("public/storage/".$whyUsSectionImages[0]['path']) }}"
          class="w-full h-full"
          alt=""
          loading="lazy"
        />
        <div class="absolute top-0 right-0 flex gap-2 border bg-white rounded-md border-[#EA5212]">
          <div class="text-[#166E1D] font-bold text-[28px] p-1">{{ $whyUsSection->content[0]['experiences']['year']}}</div>
          <div class="text-white bg-[#EA5212] font-bolder w-[100px] px-2">{{ $whyUsSection->content[0]['experiences']['title']}}</div>
        </div>
      </div>
      <div
        class="medicine-items absolute top-[270px] left-[20px] w-[320px] rounded-[8px] shadow-2xl gap-[8px] flex flex-col p-[15px] bg-[#166E1D]"
      >
        <div class="flex flex-row items-center gap-[11px] text-white">
          <image src="{{ url("public/storage/icons/Hand Coin Icon.png") }}" class="" alt="" />
          <h5 class="title">{{ $whyUsSection->content[0]['extras'][0]}}</h5>
        </div>
        <div class="flex flex-row items-center gap-[11px] text-white">
          <image src="{{ url("public/storage/icons/Medicine Icon.png") }}" class="" alt="" />
          <h5 class="title">{{$whyUsSection->content[0]['extras'][1]}}</div>
        <div class="flex flex-row items-center gap-[11px] text-white">
          <image src="{{ url("public/storage/icons/Target Icon.png") }}" class="" alt="" />
          <h5 class="title">{{$whyUsSection->content[0]['extras'][2] }}</h5>
        </div>
        <div class="flex flex-row items-center gap-[11px] text-white">
          <image src="{{ url("public/storage/icons/Watch Icon.png") }}" class="" alt="" />
          <h5 class="title">{{ $whyUsSection->content[0]['extras'][3] }}</h5>
        </div>
      </div>
    </div>
  </section>
