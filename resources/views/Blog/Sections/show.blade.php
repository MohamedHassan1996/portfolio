@include('Layout.header')
<!-- hero section -->
<!-- blogs page -->
<section>
    @include('Layout.navbar')
    <div class="blog-information py-[150px]">
        <div class="w-11/12 md:w-4/5 m-auto">
          <!-- hero blog details page -->
          <div class="hero relative">
            <img src="./public/assets/image1.png" class="w-full h-auto max-h-[480px] rounded-[15px] object-cover" alt="hero image" loading="lazy" />
            <div class="bg-[white] absolute top-[16px] right-[16px] box-border flex justify-start items-center flex-col w-[60px] py-2 rounded-lg">
              <p class="[font-family:Montserrat,sans-serif] text-2xl font-semibold leading-[29px] text-[#333333]">
                27
              </p>
              <p
                class="[font-family:Roboto,sans-serif] text-sm font-normal text-[#333333]"
              >
                Jun
              </p>
            </div>
          </div>

          <div class="mt-[40px] flex flex-col-reverse md:flex-row justify-between gap-[32px]">

            <div class="information md:w-[80%]">
              <p class="main-title [font-family:Montserrat,sans-serif] text-6xl font-bold leading-[72px] uppercase text-[#333333]">Tempore reiciendis facilis provident.</p>
              <p class="[font-family:Roboto,sans-serif] text-xl font-normal text-left leading-[30px] text-[#777777] w-full box-border mt-10">
                Molestias perferendis tempora sequi consequatur quos distinctio
                quod error ipsam. Nisi earum quam facere saepe occaecati ad sequi
                laboriosam. Sequi aut quia beatae qui. Qui et est tempora
                reiciendis sed. Sit deleniti neque rem non. Voluptatem excepturi
                cupiditate sunt qui itaque nobis. Sapiente provident qui pariatur
                labore ad. Et est laudantium commodi eos aut omnis nesciunt. Vel
                voluptatem est. Modi rerum ad at dolores id inventore soluta vel.
                Iusto nihil labore tempore repudiandae dolor ea.Molestias
                perferendis tempora sequi consequatur quos distinctio quod error
                ipsam. Nisi earum quam facere saepe occaecati ad sequi laboriosam.
                Sequi aut quia beatae qui. Qui et est tempora reiciendis sed. Sit
                deleniti neque rem non. Voluptatem excepturi cupiditate sunt qui
                itaque nobis. Sapiente provident qui pariatur labore ad. Et est
                laudantium commodi eos aut omnis nesciunt. Vel voluptatem est.
                Modi rerum ad at dolores id inventore soluta vel. Iusto nihil
                labore tempore repudiandae dolor ea.Molestias perferendis tempora
                sequi consequatur quos distinctio quod error ipsam. Nisi earum
                quam facere saepe occaecati ad sequi laboriosam. Sequi aut quia
                beatae qui. Qui et est tempora reiciendis sed. Sit deleniti neque
                rem non. Voluptatem excepturi cupiditate sunt qui itaque nobis.
                Sapiente provident qui pariatur labore ad. Et est laudantium
                commodi eos aut omnis nesciunt. Vel voluptatem est. Modi rerum ad
                at dolores id inventore soluta vel. Iusto nihil labore tempore
                repudiandae dolor ea.
              </p>
            </div>

            <!-- right controles status & Latest -->
            <div  class="border bg-[white] h-[fit-content] box-border flex justify-start items-stretch flex-col gap-[31px] pt-[39px] px-[10px] rounded-lg border-solid border-[#e8e8e8]">
              <div>
                <!-- Input Component is detected here -->
                <div class="border bg-[#fbfcf8] h-[50px] box-border flex flex-row items-center [justify-content:start] rounded-sm border-solid border-[#333333]">
                  <input
                    placeholder="Search"
                    type="text"
                    class="w-full [font-family:Roboto,sans-serif] text-base font-normal bg-transparent [outline:none] box-border ml-3 border-[none] text-[#8e8e8e]"
                  />
                  <div class="w-6 h-6 text-[#333333] flex mr-[13px] my-[13px]">
                    <img src="./public/icons/search.svg" alt="" />
                  </div>
                </div>
              </div>
              <div class="">
                <p
                  class="[font-family:Montserrat,sans-serif] text-[17px] font-semibold leading-[20.5px] uppercase text-[#333333]"
                >
                  Categories
                </p>
                <div
                  class="flex justify-center items-stretch flex-col gap-4 box-border mt-4"
                >
                  <div
                    class="rounded bg-[rgba(51,51,51,0.04)] box-border flex justify-between items-center flex-row gap-2 h-[43px] px-[15px]"
                  >
                    <p
                      class="[font-family:Roboto,sans-serif] text-lg font-medium text-[#333333] m-0 p-0"
                    >
                      Veniam et odio
                    </p>
                    <p
                      class="[font-family:Roboto,sans-serif] text-lg font-medium text-[#333333] m-0 p-0"
                    >
                      33
                    </p>
                  </div>
                  <div
                    class="rounded bg-[rgba(51,51,51,0.04)] box-border flex justify-between items-center flex-row gap-2 h-[43px] px-[15px]"
                  >
                    <p
                      class="[font-family:Roboto,sans-serif] text-lg font-medium text-[#333333] m-0 p-0"
                    >
                      Ut tempora ut
                    </p>
                    <p
                      class="[font-family:Roboto,sans-serif] text-lg font-medium text-[#333333] m-0 p-0"
                    >
                      12
                    </p>
                  </div>
                  <div
                    class="rounded bg-[rgba(51,51,51,0.04)] box-border flex justify-between items-center flex-row gap-2 h-[43px] px-[15px]"
                  >
                    <p
                      class="[font-family:Roboto,sans-serif] text-lg font-medium text-[#333333] m-0 p-0"
                    >
                      Nt porro eum
                    </p>
                    <p
                      class="[font-family:Roboto,sans-serif] text-lg font-medium text-[#333333] m-0 p-0"
                    >
                      45
                    </p>
                  </div>
                  <div
                    class="rounded bg-[rgba(51,51,51,0.04)] box-border flex justify-between items-center flex-row gap-2 h-[43px] px-[15px]"
                  >
                    <p
                      class="[font-family:Roboto,sans-serif] text-lg font-medium text-[#333333] m-0 p-0"
                    >
                      Nihil voluptatem dolores
                    </p>
                    <p
                      class="[font-family:Roboto,sans-serif] text-lg font-medium text-[#333333] m-0 p-0"
                    >
                      22
                    </p>
                  </div>
                </div>
              </div>
              <div class="">
                <p
                  class="[font-family:Montserrat,sans-serif] text-[17px] font-semibold leading-[20.5px] uppercase text-[#333333] m-0 p-0"
                >
                  Latest posts
                </p>
                <div class="w-[100.00%] box-border my-4">
                  <div class="rounded bg-[rgba(51,51,51,0.04)] box-border flex justify-center items-center flex-row w-[100.00%] h-[100px] pl-2 pr-[7px] first:mt-0 mt-[16.00px]">
                    <img
                      class="rounded h-[69px] max-w-[initial] object-cover w-[85px] box-border block border-[none]"
                      src="./public/assets/Frame 239.png"
                    />
                    <div class="grow-0 shrink basis-auto ml-[7px] py-2">
                      <div
                        class="bg-[rgba(51,51,51,0.04)] box-border flex justify-start items-center flex-col w-[35px] rounded-[999px]"
                      >
                        <p
                          class="[font-family:Roboto,sans-serif] text-[8px] font-normal text-[#333333] m-0 p-0"
                        >
                          Ui Ux
                        </p>
                      </div>
                      <p
                        class="[font-family:Roboto,sans-serif] text-lg font-medium text-left leading-[27px] text-[#333333] w-[100.00%] mt-[3px] m-0 p-0"
                      >
                        Occaecati ea doloremque nemo ipsa.
                      </p>
                    </div>
                  </div>
                  <div
                    class="rounded bg-[rgba(51,51,51,0.04)] box-border flex justify-center items-center flex-row w-[100.00%] h-[85px] pl-2 pr-[7px] first:mt-0 mt-[16.00px]"
                  >
                    <img
                      class="rounded h-[69px] max-w-[initial] object-cover w-[85px] border-[none]"
                      src="./public/assets/Frame 239.png"
                    />
                    <div class="grow-0 shrink basis-auto ml-[7px] py-2">
                      <div
                        class="bg-[rgba(51,51,51,0.04)] box-border flex justify-start items-center flex-col w-[35px] rounded-[999px]"
                      >
                        <p
                          class="[font-family:Roboto,sans-serif] text-[8px] font-normal text-[#333333]"
                        >
                          Ui Ux
                        </p>
                      </div>
                      <p
                        class="[font-family:Roboto,sans-serif] text-lg font-medium text-left leading-[27px] text-[#333333] box-border mt-[3px]"
                      >
                        Occaecati ea doloremque nemo ipsa.
                      </p>
                    </div>
                  </div>
                  <div
                    class="rounded bg-[rgba(51,51,51,0.04)] box-border flex justify-center items-center flex-row w-[100.00%] h-[85px] pl-2 pr-[7px] first:mt-0 mt-[16.00px]"
                  >
                    <img
                      class="rounded h-[69px] max-w-[initial] object-cover w-[85px] box-border block border-[none]"
                      src="./public/assets/Frame 239.png"
                    />
                    <div class="grow-0 shrink basis-auto ml-[7px] py-2">
                      <div
                        class="bg-[rgba(51,51,51,0.04)] box-border flex justify-start items-center flex-col w-[35px] rounded-[999px]"
                      >
                        <p
                          class="[font-family:Roboto,sans-serif] text-[8px] font-normal text-[#333333]"
                        >
                          Ui Ux
                        </p>
                      </div>
                      <p
                        class="[font-family:Roboto,sans-serif] text-lg font-medium text-left leading-[27px] text-[#333333] mt-[3px] m-0 p-0"
                      >
                        Occaecati ea doloremque nemo ipsa.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

</section>
@include('Layout.footer')
