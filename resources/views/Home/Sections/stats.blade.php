<!-- status numbres -->
<section class="bg-[#f5f5f3]">
    <div class="w-4/5 sm:w-4/5 m-auto flex items-center flex-col lg:flex-row box-border justify-between gap-[50px] py-12">
        @foreach ($statsSection->content as $index => $stat)
      <div class="flex justify-center items-center flex-col">
        <p
          class="stats-counter [font-family:Montserrat,sans-serif] text-[56px] font-bold leading-[67px] text-[#166e1d]"
        >
          {{ $stat['number'] }}
        </p>
        <p
          class="[font-family:Roboto,sans-serif] text-xl font-normal text-center text-[#777777] w-[139px] mt-1"
        >
          {{ $stat['heading'] }}
        </p>
      </div>
      @endforeach
    </div>
  </section>
