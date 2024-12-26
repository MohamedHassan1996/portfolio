@include('Layout.header')
<!-- hero section -->
<section>
    @php
        $data = $homePage->sections->first()->content[0];
        $mainHeading = $data['main_heading'];
        $mainButton = $data['main_btn'];
        $mainText = $data['main_text'];
    @endphp
<!-- hero section -->
<section>
    <div class="flex justify-start flex-col box-border pt-[150px] w-11/12 md:w-4/5 m-auto">
      <div class="hero-section-top flex justify-between">
        <div class="flex justify-start items-center flex-row">
          <div class="flex justify-center flex-col">
            <h1 class="hero-title [font-family:Montserrat,sans-serif] font-[900] w-4/5 text-[88px] font-bold text-left leading-[97px] uppercase text-[#2b2b2b]">
              {{ $mainHeading }}
            </h1>
            <a
              href="#about-us-section"
              class="hero-btn rounded border bg-transparent [font-family:Roboto,sans-serif] text-[#ea5212] hover:bg-[#ea5212] hover:text-[white] transition-colors cursor-pointer h-[41px] w-[151px] inline-flex items-center justify-center gap-[3px] box-border mt-[23.5px] border-solid border-[#ea5212]"
            >
              <span>{{ $mainButton }}</span>
              <img src="./public/icons/home-hero-btn.svg" alt="" />
            </a>
          </div>
        </div>
        <div class="imageSection">
          <img src="./public/assets/hero.png" class="img-hero-section w-[600px]" alt="" />
          <p
            class="[font-family:Roboto,sans-serif] text-xl text-center leading-[30px] text-[#777777] max-w-[411px] mt-8"
          >
            {{ $mainText }}
          </p>
        </div>
      </div>
    </div>
    <div class="flex justify-start items-center flex-col">
      <p
        class="[font-family:Roboto,sans-serif] text-xl font-normal text-[#166e1d] m-0 p-0"
      >
        Scroll for more
      </p>
      <div class="mt-[6.5px]">
        <img
          src="./public/assets/image_147d625.png"
          alt="image"
          loading="lazy"
          class="h-[35px] max-w-[initial] w-[22.5px] block box-border"
        />
      </div>
    </div>
  </section>
</section>@include('Layout.footer')
