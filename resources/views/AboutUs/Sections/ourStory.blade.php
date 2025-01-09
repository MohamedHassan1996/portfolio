<div class="aboutus-page">
    <div class="w-11/12 sm:w-4/5 m-auto px-[8px]">
      <!-- title  -->
      <div>
        <h2 class="text-[#166e1d] pt-40">
          <span>{{ $ourStorySection->content[0]['subTitle'] }}</span>
          <span class="text-base font-medium text-[#ea5212]">...</span>
        </h2>
        <h1 class="main-title text-6xl font-bold [font-family:Montserrat,sans-serif] uppercase  text-[#333333] mt-2">
          <span>{{ $ourStorySection->content[0]['heading'] }}</span><span class="text-[#ea5212]">.</span>
        </h1>
      </div>

      <!-- hero section -->
      <section class="flex justify-start items-center flex-col">
        <div
          class="flex justify-center items-stretch flex-col box-border pb-24"
        >
          <div
            class="heroSection-aboutus-page flex justify-between items-center flex-row mt-12"
          >
          <div class="[font-family:Roboto,sans-serif] text-2xl flex gap-5  flex-col font-normal leading-[29px] text-[#8E8E8E]">
          @foreach ($ourStorySection->content[0]['descriptions'] as $description)

          <p
          class="[font-family:Roboto,sans-serif] text-2xl font-normal leading-[29px] text-[#8e8e8e]"
        >
          {{ $description }}

        </p>
          @endforeach
        </div>
            <img
              src="{{ url("storage/".$ourStorySectionImages[0]['path']) }}"
              class="object-cover w-[100%] md:w-[495px] box-border rounded-lg border-[none]"
            />
          </div>
        </div>
      </section>
      <!-- hero section -->
    </div>
