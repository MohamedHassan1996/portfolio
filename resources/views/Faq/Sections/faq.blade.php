<!-- about us -->
<section class="flex bg-[#FBFCF8] relative" id="about-us-section">
    <img src="./public/assets/image_gradient.png" alt="Background" class="background-image z-0 top-0 left-0 absolute" />
    <div class="w-11/12 md:w-4/5 m-auto py-40">
      <div class="flex flex-col md:flex-row justify-between items-center gap-[35px]">
        <div class="w-full md:w-[40%]">
          <h4 class="[font-family:Montserrat,sans-serif] text-[18px] font-semibold leading-[20.5px] text-[#166e1d] min-w-[96px] h-9 w-24">
            {{ $aboutUsSection->content[0]['subTitle'] }}
          </h4>
          <h2 class="main-title [font-family:Montserrat,sans-serif] text-[32px] md:text-[64px] leading-[40px] md:leading-[70px] font-bold text-left uppercase text-[#333333] mt-2">
            <span>{{ $aboutUsSection->content[0]['heading'] }}</span>
          </h2>
          <p class="[font-family:Roboto,sans-serif] text-[16px] md:text-[20px] font-normal text-left leading-[24px] md:leading-[29px] text-[#8e8e8e]">
            {{ $aboutUsSection->content[0]['description'] }}
          </p>
        </div>

        <div class="images-section flex flex-col md:flex-row items-end">
          <img src="{{ url("storage/".$aboutUsSectionImages[0]['path']) }}" class="about-image-secondary mb-4 md:mb-0" alt="about-image-secondary" />
          <img src="{{ url("storage/".$aboutUsSectionImages[1]['path']) }}" class="about-image-primary" alt="about-image-primary" />
        </div>

      </div>
    </div>
  </section>
