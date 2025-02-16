@include('Layout.header')
<!-- hero section -->
<!-- blogs page -->
<section>
    @include('Layout.navbar')
    <div class="career-details-page">
        <div
          class="w-11/12 sm:w-4/5 m-auto flex flex-col md:flex-row justify-start items-start gap-8 box-border pt-40 pb-24"
        >
          <div class="flex-1">
            <h2
              class="main-title [font-family:Montserrat,sans-serif] text-4xl md:text-6xl font-bold leading-[72px] uppercase text-[#333333]"
            >
              {{ $career->title }}<span class="text-[#ea5212]">.</span>
            </h2>
            <div class="box-border mt-10">
              {!! $career->content !!}
            </div>
          </div>

          <div class="bg-white shadow rounded-lg box-border py-8 flex justify-center items-stretch flex-col mx-auto px-6 w-full max-w-[500px]">
            <div class="flex justify-center items-stretch flex-col gap-4">
              @foreach ($career->extra_details as $detail)
              <div class="location bg-[rgba(51,51,51,0.04)] flex justify-center sm:justify-between flex-col sm:flex-row items-center flex-row gap-0 sm:gap-2 h-[61px] pl-4 pr-3 rounded-lg w-full"
              >
                <div class="flex justify-start items-center flex-row">
                  {{-- <img
                    src="./public/icons/location-icon.svg"
                    alt="location-icon"
                    class="w-6 h-6"
                    loading="lazy"
                  /> --}}
                  <p
                    class="[font-family:Roboto,sans-serif] text-lg font-normal text-[#333333]"
                  >
                    {{ $detail['title'] }}
                  </p>
                </div>
                <p
                  class="[font-family:Roboto,sans-serif] text-sm font-medium text-[#166e1d]"
                >
                {{ $detail['value'] }}

                </p>
              </div>

              @endforeach
            </div>
            <button class="apply-jop rounded border bg-transparent [font-family:Roboto,sans-serif] text-base font-medium text-[#166e1d] w-full max-w-[450px] h-[49px] block box-border mt-6 hover:bg-[#166e1d] hover:text-white border-solid border-[#166e1d]">
              Apply Now
            </button>
          </div>
        </div>
      </div>

      <!-- modle form jop -->
      <div class="overlay-modle-career z-50 fixed inset-0 bg-black bg-opacity-50 items-center justify-center" style="display: none">
        <div class="formjop rounded-[15px] px-[10px] sm:px-[40px] py-[30px] bg-[#FBFCF8] w-[300px] overflow-x-hidden md:w-[675px] h-[700px] absolute top-[20px] shadow-2xl overflow-scroll">
          <h1 class="main-title [font-family:Montserrat,sans-serif] text-5xl font-bold text-left leading-[72px] uppercase text-[#333333]">
            Apply details<span class="text-[#ea5212]">.</span>
          </h1>
          <form class="jopForm py-[32px] px-[10px] sm:px-[24px] mt-[10px] flex flex-col gap-[32px]">
            <input type="hidden" value="{{ $career->id }}">
            <div class="flex flex-col md:flex-row justify-between gap-[16px]">

              <div class="name flex flex-col gap-[16px] w-full">
                <label for="name" class="capitalize font-bold">name</label>
                <input
                  type="name"
                  name="name"
                  id="name"
                  placeholder="Brooklyn Simmons"
                  class="text-[#333] rounded-[2px] outline-none p-[12px] border border-[1px] border-solid border-[#333]"
                />
              </div>
              <div class="phone flex flex-col gap-[16px] w-full">
                <label for="phone" class="capitalize font-bold"
                  >phone number</label
                >
                <input
                  type="phone"
                  name="phone"
                  id="phone"
                  placeholder="(316) 555-0116"
                  class="text-[#333] rounded-[2px] outline-none p-[12px] border border-[1px] border-solid border-[#333]"
                />
              </div>

            </div>

            <div class="email flex flex-col gap-[16px]">
              <label for="email" class="capitalize font-bold">email</label>
              <input
                type="email"
                name="email"
                id="email"
                placeholder="example@mail.com"
                class="text-[#333] rounded-[2px] outline-none p-[12px] border border-[1px] border-solid border-[#333]"
              />
            </div>

            <div class="cv flex flex-col gap-[16px] w-full relative">
              <label for="cv" class="capitalize font-bold text-[#333] mb-2">Upload CV</label>
              <div class="flex items-center border border-[#333] rounded-[4px] bg-[#f9f9f9] p-2">
                <input
                  type="file"
                  name="cv-upload"
                  id="cv-upload"
                  class="flex-1 cursor-pointer bg-transparent outline-none"
                  aria-label="Upload your CV"
                  accept=".pdf,.doc,.docx"
                />
                <label for="cv-upload" class="flex items-center justify-center cursor-pointer">
                  <img src="./public/icons/upload-icon.svg" alt="Upload Icon" class="w-6 h-6" />
                </label>
              </div>
              <p class="text-[red] text-sm mt-1">*Accepted formats: PDF, DOC, DOCX</p> <!-- Added helper text -->
            </div>

            <div class="cover-letter flex flex-col gap-[16px] w-full relative">
              <label for="cover-letter" class="capitalize font-bold"
                >cover letter</label
              >
              <textarea
                type="cover-letter"
                name="cover-letter"
                id="cover-letter"
                placeholder="Upload your cv.."
                class="text-[#333] h-[180px] rounded-[2px] outline-none p-[12px] border border-[1px] border-solid border-[#333]"
              ></textarea>
            </div>
            <button
              type="submit"
              class="capitalize text-[white] h-[50px] rounded-[4px] bg-[#166E1D]"
            >
              send
            </button>
          </form>
          <button class="close-career-modle absolute top-[24px] right-[24px]">
            <img src="./public/icons/_CrossIcon_.png" alt="" />
          </button>
        </div>
      </div>


</section>
<script>
    /* career jop modle */
    function toggleModal(buttonSelector, modalSelector, displayStyle) {
      const button = document.querySelector(buttonSelector);
      button.addEventListener("click", () => {
        document.querySelector(modalSelector).style.display = displayStyle;
      });
    }

    toggleModal(".apply-jop", ".overlay-modle-career", "flex");
    toggleModal(".close-career-modle", ".overlay-modle-career", "none");

    const form = document.querySelector(".jopForm");
      form.addEventListener("submit", async function (event) {
        event.preventDefault();
        const formData = new FormData(form);

        try {
          const response = await fetch("https://mbopharma.com/api/v1/website/send-candidate/create", {
            method: "POST", body: formData,
          });

          if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
          }

          const result = await response.json();
          alert("Application submitted successfully!");
          console.log(result);
        } catch (error) {
          alert("Failed to submit the form!");
          console.error("Error:", error);
        }
      });
  </script>
@include('Layout.footer')
