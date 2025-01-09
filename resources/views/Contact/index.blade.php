@include('Layout.header')
<!-- hero section -->
<section>
    @include('Layout.navbar')
    <!-- products -->
    <section class="contactus-page">
        <div class="w-11/12 lg:w-4/5 m-auto pb-[11.5px] pt-40">

          @if (app()->getLocale() == 'en')
          <h2 class="main-title [font-family:Montserrat,sans-serif] text-6xl font-bold text-left leading-[72px] uppercase text-[#333333]">
            <span>Get in </span>
            <span>Touch</span>
            <span> to Empower </span>
            <span class="text-[#ea5212]">Your</span>
            <span> Vision</span><span class="text-[#ea5212]">.</span>
          </h2>
          @elseif (app()->getLocale() == 'ar')
          <h2 class="main-title [font-family:Montserrat,sans-serif] text-6xl font-bold text-left leading-[72px] uppercase text-[#333333]"></h2>
            <span>اتصل بنا</span>
            <span> لتحقيق </span>
            <span> رؤيتك </span>
            <span class="text-[#ea5212]">.</span>
            </h2>
          @endif

          <form class="contactPage-responsive flex justify-between gap-[45px] items-start flex-row gap-2 box-border mt-20">
            <div class="w-full max-w-[500px] md:max-w-[550px] m-auto">
              <div class="box-border">
                <!-- name and phone -->
                <div class="flex justify-start items-center gap-[20px] flex-col md:flex-row w-full box-border">
                  <div class="main-inputs flex justify-center items-stretch flex-col grow shrink basis-0 gap-[10px]">
                    <label for="name" class="[font-family:Montserrat,sans-serif] text-[17px] font-semibold leading-[20.5px] text-[#333333] mt-[15px]">Name</label>
                    <input placeholder="Brooklyn Simmons" type="text" id="name" class="border bg-[#fbfcf8] h-[50px] [font-family:Roboto,sans-serif] text-base font-normal box-border pl-3 rounded-sm border-solid border-[#333333] text-[#8e8e8e]" />
                  </div>
                  <div class="main-inputs flex justify-center items-stretch flex-col grow shrink basis-0 gap-[10px]">
                    <label for="mobile-phone" class="[font-family:Montserrat,sans-serif] text-[17px] font-semibold leading-[20.5px] text-[#333333] mt-[15px]" >Mobile Phone</label>
                    <input placeholder="+20 1007 4815 557" type="text" id="mobile-phone" class="border bg-[#fbfcf8] h-[50px] [font-family:Roboto,sans-serif] text-base font-normal box-border pl-3 rounded-sm border-solid border-[#333333] text-[#8e8e8e]" />
                  </div>
                </div>

                <!-- email -->
                <div
                  class="h-[85px] w-[100.00%] mt-[31px] box-border flex-row items-center [justify-content:start] border-[none]"
                >
                  <label
                    for="email"
                    class="[font-family:Montserrat,sans-serif] text-[17px] font-semibold leading-[20.5px] text-[#333333] block mb-[15px]"
                  >
                    Email
                  </label>
                  <input
                    id="email"
                    placeholder="example@mail.com"
                    type="text"
                    class="border h-[50px] w-full box-border bg-[#fbfcf8] [font-family:Roboto,sans-serif] text-base font-normal pl-3 rounded-sm border-solid border-[#333333] text-[#8e8e8e]"
                  />
                </div>

                <div class="w-[100.00%] box-border mt-[31px]">
                  <p
                    class="[font-family:Montserrat,sans-serif] text-[17px] font-semibold leading-[20.5px] text-[#333333] m-0 p-0"
                  >
                    Subject
                  </p>
                  <div class="w-[100.00%] box-border mt-[15px]">
                    <!-- Input Component is detected here -->
                    <input
                      placeholder="Career"
                      type="text"
                      class="border bg-[#fbfcf8] h-[50px] w-[100.00%] [font-family:Roboto,sans-serif] text-base font-normal box-border pl-3 rounded-sm border-solid border-[#333333] text-[#8e8e8e]"
                    />
                  </div>
                </div>

                <div class="w-[100.00%] box-border mt-[31px]">
                  <label
                    for="message"
                    class="[font-family:Montserrat,sans-serif] text-[17px] font-semibold leading-[20.5px] text-[#333333] m-0 p-0"
                  >
                    Message
                  </label>
                  <textarea
                    placeholder="message"
                    id="message"
                    class="rounded border min-h-[200px] bg-[#fbfcf8] box-border flex justify-start items-start flex-col w-[100.00%] mt-[15px] pl-3 pr-[2.25px] pt-[13px] pb-0.5 border-solid border-[#333333]"
                  ></textarea>
                </div>
              </div>
              <!-- Button Component is detected here -->
              <button
                class="rounded border bg-transparent [font-family:Roboto,sans-serif] text-base font-medium text-[#ea5212] cursor-pointer min-w-[131px] h-[41px] w-[131px] block box-border mt-[22.5px] border-solid hover:bg-[#ea5212] hover:text-[#fff] border-[#ea5212]"
              >
                Send Message
              </button>
            </div>

            <!-- map and location -->
            <div class="border box-border rounded-lg border-solid border-[#e8e8e8] w-full sm:w-[90%] mx-auto">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1172.7072262053896!2d31.335977819574488!3d31.04707961734824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2seg!4v1732058217561!5m2!1sen!2seg"
                height="450"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                class="h-[405px] object-cover w-[100.00%] box-border block rounded-[8px_8px_0px_0px] border-[none]"
              ></iframe>
              <div
                class="border bg-[white] box-border flex justify-start items-start flex-row w-[100.00%] rounded-[0px_0px_8px_8px] border-solid border-[#e8e8e8]"
              >
                <div
                  class="bg-[white] box-border grow-0 shrink basis-[248px] pt-4 pb-6 px-[15px] border-r-[#e8e8e8] border-r border-solid"
                >
                  <p
                    class="[font-family:Montserrat,sans-serif] text-sm font-semibold leading-[17px] text-[#333333] m-0 p-0"
                  >
                    Get To Know Us
                  </p>
                  <div
                    class="flex justify-start items-start flex-row w-[100.00%] box-border mt-2"
                  >
                    <div class="grow-0 shrink-0 basis-auto pb-[22px]">
                      <div class="w-5 h-5 text-[#166e1d] flex">
                        <svg
                          viewBox="0 0 20 20"
                          x="0"
                          y="0"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <g
                            id="Icon / &lt;LocationIcon>"
                            data-node-id="5238:1965"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              id="Vector_2"
                              data-node-id="I5238:1965;158:792"
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M10,17.5c-1.9,0 -5,-7.238 -5,-10c0,-1.326 0.527,-2.598 1.464,-3.536c0.938,-0.937 2.21,-1.464 3.536,-1.464c1.326,0 2.598,0.527 3.536,1.464c0.937,0.938 1.464,2.21 1.464,3.536c0,2.762 -3.1,10 -5,10zM10,10c0.319,0 0.634,-0.063 0.929,-0.185c0.294,-0.122 0.562,-0.3 0.787,-0.526c0.225,-0.225 0.404,-0.493 0.526,-0.787c0.122,-0.294 0.185,-0.61 0.185,-0.929c0,-0.318 -0.063,-0.634 -0.185,-0.928c-0.122,-0.295 -0.301,-0.562 -0.526,-0.788c-0.225,-0.225 -0.493,-0.404 -0.787,-0.526c-0.295,-0.122 -0.61,-0.184 -0.929,-0.184c-0.644,0 -1.261,0.255 -1.716,0.71c-0.455,0.456 -0.711,1.073 -0.711,1.716c0,0.644 0.256,1.261 0.711,1.716c0.455,0.455 1.072,0.711 1.716,0.711z"
                              fill="currentColor"
                            />
                          </g>
                        </svg>
                      </div>
                    </div>
                    <p
                      class="[font-family:Roboto,sans-serif] text-sm font-normal text-left leading-[21px] text-[#166e1d] grow-0 shrink basis-auto ml-[7px] m-0 p-0"
                    >
                      2464 Royal Ln. Mesa, New Jersey 45463
                    </p>
                  </div>
                </div>
                <div
                  class="bg-[white] box-border grow-0 shrink-0 basis-[248px] -ml-px px-[15.5px] py-4 border-l-[#e8e8e8] border-l border-solid"
                >
                  <p
                    class="[font-family:Montserrat,sans-serif] text-sm font-semibold leading-[17px] text-[#333333] m-0 p-0"
                  >
                    Get In Touch
                  </p>
                  <div
                    class="flex justify-center items-stretch flex-col w-[100.00%] box-border mt-2"
                  >
                    <div
                      class="flex justify-start items-center flex-row grow-0 shrink-0 basis-auto"
                    >
                      <div
                        class="w-5 h-5 text-[#166e1d] flex grow-0 shrink-0 basis-auto"
                      >
                        <svg
                          viewBox="0 0 20 20"
                          x="0"
                          y="0"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <g
                            id="Icon / &lt;MobileIcon>"
                            data-node-id="5238:1974"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              id="vector"
                              data-node-id="I5238:1974;158:527"
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M5.83,1.667c-0.92,0 -1.66,0.746 -1.66,1.666v13.334c0,0.92 0.74,1.666 1.66,1.666h8.34c0.92,0 1.66,-0.746 1.66,-1.666v-13.334c0,-0.92 -0.74,-1.666 -1.66,-1.666zM14.17,3.333h-8.34v10.834h8.34zM11.67,15.833h-3.34v0.834h3.34z"
                              fill="currentColor"
                            />
                          </g>
                        </svg>
                      </div>
                      <p
                        class="[font-family:Roboto,sans-serif] text-sm font-normal text-[#166e1d] grow-0 shrink-0 basis-auto ml-[7px] m-0 p-0"
                      >
                        (406) 555-0120
                      </p>
                    </div>
                    <div
                      class="flex justify-start items-center flex-row grow-0 shrink-0 basis-auto mt-2"
                    >
                      <div
                        class="w-5 h-5 text-[#166e1d] flex grow-0 shrink-0 basis-auto"
                      >
                        <svg
                          viewBox="0 0 20 20"
                          x="0"
                          y="0"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <g
                            id="Icon / &lt;EmailIcon>"
                            data-node-id="5238:1978"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <g id="Vector_3" data-node-id="I5238:1978;158:558">
                              <path
                                d="M4.17,5.833v8.334h11.66v-8.334zM15.83,4.167c0.92,0 1.67,0.75 1.67,1.666v8.334c0,0.916 -0.75,1.666 -1.67,1.666h-11.66c-0.92,0 -1.67,-0.75 -1.67,-1.666v-8.334c0,-0.916 0.75,-1.666 1.67,-1.666z"
                                fill="currentColor"
                              />
                              <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M4.58,5.417h-1.98c0.13,0.366 0.34,0.711 0.63,1.004l4.9,4.901c0.24,0.241 0.53,0.433 0.84,0.563c0.32,0.131 0.66,0.198 1,0.198c0.34,0 0.68,-0.067 0.99,-0.198c0.32,-0.13 0.6,-0.322 0.85,-0.563l4.9,-4.901c0.29,-0.293 0.5,-0.638 0.62,-1.004h-1.98l-4.72,4.726c-0.09,0.087 -0.19,0.156 -0.31,0.203c-0.11,0.046 -0.23,0.071 -0.35,0.071c-0.13,0 -0.25,-0.025 -0.36,-0.071c-0.11,-0.047 -0.22,-0.116 -0.3,-0.203z"
                                fill="currentColor"
                              />
                            </g>
                          </g>
                        </svg>
                      </div>
                      <p
                        class="[font-family:Roboto,sans-serif] text-sm font-normal text-[#166e1d] grow-0 shrink-0 basis-auto ml-[7px] m-0 p-0"
                      >
                        curtis.weaver@example.com
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- map and location -->

          </form>

        </div>
      </section>
</section>
{{-- @include('Home.Sections.aboutUs', [
    'aboutUsSection' => $aboutUsSection,
    'aboutUsSectionImages' => $aboutUsSectionImages,
]) --}}


@include('Layout.footer')
