@include('Layout.header')
<!-- hero section -->
<section>
    @php
        $data = $homePage->sections;
        $heroSection = $data->first();
        $heroSectionImages = $heroSection->images;
        $aboutUsSection = $data->skip(1)->first();
        $aboutUsSectionImages = $aboutUsSection->images;
        $productsSection = $data->skip(2)->first();
        $whyUsSection = $data->skip(3)->first();
        $whyUsSectionImages = $whyUsSection->images;
        $statsSection = $data->skip(4)->first();
        $blogSection = $data->skip(5)->first();
    @endphp
<!-- hero section -->
<section class="heroSection">
    @include('Layout.navbar')
    <div class="flex justify-start flex-col box-border pt-[150px] w-11/12 md:w-4/5 m-auto">
      <div class="hero-section-top flex justify-between">
        <div class="flex justify-start items-center flex-row">
          <div class="flex justify-center flex-col">
            <h1 class="hero-title [font-family:Montserrat,sans-serif] font-[900] w-4/5 text-[88px] font-bold text-left leading-[97px] uppercase text-[#2b2b2b]">
              {{ $heroSection->content[0]['heading'] }}
            </h1>
            <a
              href="#about-us-section"
              class="hero-btn rounded border bg-transparent [font-family:Roboto,sans-serif] text-[#ea5212] hover:bg-[#ea5212] hover:text-[white] transition-colors cursor-pointer h-[41px] w-[151px] inline-flex items-center justify-center gap-[3px] box-border mt-[23.5px] border-solid border-[#ea5212]"
            >
              <span>{{ $heroSection->content[0]['btnText'] }}</span>
              <img class="arrow-icon" src="{{ url('public/storage/icons/home-hero-btn.svg') }}" alt="" />
            </a>
          </div>
        </div>
        <div class="imageSection max-w-[400px]">
          <img src="{{ url("storage/".$heroSectionImages[0]['path']) }}" class="img-hero-section max-w-full" alt="" />
          <p
            class="[font-family:Roboto,sans-serif] text-xl text-center leading-[30px] text-[#777777] max-w-[411px] mt-8"
          >
            {{ $heroSection->content[0]['description'] }}
          </p>
        </div>
      </div>
    </div>
    <div class="flex justify-start items-center flex-col">
      <p
        class="[font-family:Roboto,sans-serif] text-xl font-normal text-[#166e1d] m-0 p-0"
      >
      </p>
      <div class="mt-[6.5px]">
        <img
        src="{{ url('public/storage/assets/scroll.png') }}"
        alt="image"
          loading="lazy"
          class="h-[35px] max-w-[initial] w-[22.5px] block box-border"
        />
      </div>
    </div>
  </section>
</section>
@include('Home.Sections.aboutUs', [
    'aboutUsSection' => $aboutUsSection,
    'aboutUsSectionImages' => $aboutUsSectionImages,
])
@include('Home.Sections.productsSlider', [
    'productsSection' => $productsSection,
    'products' => $products,
])
@include('Home.Sections.whyUs', [
    'whyUsSection' => $whyUsSection,
    'whyUsSectionImages' => $whyUsSectionImages,
])
@include('Home.Sections.stats', [
    'statsSection' => $statsSection,
])
@include('Home.Sections.blog', [
    'blogSection' => $blogSection,
    'blogs' => $blogs
])

@include('Layout.footer')
