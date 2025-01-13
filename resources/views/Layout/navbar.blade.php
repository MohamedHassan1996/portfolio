      <!-- nav bar -->
      {{-- @php
      $currentUrl = url()->current();
      $restOfUrl = substr($currentUrl, strlen($baseUrl));
      @endphp --}}
      <section class="navigation-bar" id="header">
        <div class="nav-container">
          <div class="brand-links">
            <!-- Brand Logo -->
            <a href="{{ route('dynamic.page', ['slug' => '', 'lang' => app()->getLocale() == 'en' ? '':app()->getLocale() ]) }}" class="brand">
              <img
                src="{{ url('public/storage/assets/image_5d73f37c.jpeg') }}"
                alt="Brand"
                class="brand-logo"
              />
            </a>

            <!-- Navigation Links -->
            <div class="nav-links">
                @foreach ($navbarLinks as $navbarLink)
                    @if (!in_array($navbarLink->controller_name, ['CareerPageController', 'ContactPageController']))
                        <a href="{{ route('dynamic.page', ['lang' => app()->getLocale() == 'en' ? '':app()->getLocale(), 'slug' => $navbarLink->slug]) }}"
                           class="nav-link {{ session('active_navbar_link') === $navbarLink->slug ? 'active' : '' }}">
                            {{ $navbarLink->title }}
                        </a>
                    @endif
                @endforeach
            </div>

          </div>

          <!-- Contact Us Button -->
        <div class="flex gap-5 flex-row-reverse">
            @if (app()->getLocale() == 'en')
            <a href="{{  route('dynamic.page', ['slug' => 'contact-us', 'lang' => '']) }}" class="contact-button">
                Contact Us
            @else
            <a href="{{ route('dynamic.page', ['slug' => 'اتصل-بنا', 'lang' => app()->getLocale()]) }}" class="contact-button">
                تواصل معنا
            @endif
                <img class="arrow-icon" src="{{  url('public/storage/icons/arrow.png') }}" alt="Arrow Icon" />
            </a>
            <!-- language picker -->
            <div class="custom-select relative w-[100px] cursor-pointer">
                            <div
                              class="selected-option flex items-center p-2 border border-gray-300 rounded bg-white rounded-lg"
                            >
                              <img
                                src="https://flagcdn.com/w320/gb.png"
                                alt="English Flag"
                                class="flag-icon w-[20px] h-[15px] mr-2"
                              />
                              English
                            </div>
                            <ul class="options">
                                <li data-value="ar">
                                  <img
                                    src="https://flagcdn.com/w320/eg.png"
                                    alt="Arabic Flag"
                                    class="flag-icon w-[20px] h-[15px] mr-2"
                                  />
                                  <a class="language-picker"
                                    href="javascript:void(0)"
                                    data-lang="ar"
                                  >
                                    العربية
                                  </a>
                                </li>
                                <li data-value="en">
                                  <img
                                    src="https://flagcdn.com/w320/gb.png"
                                    alt="English Flag"
                                    class="flag-icon w-[20px] h-[15px] mr-2"
                                  />
                                  <a class="language-picker"
                                    href="javascript:void(0)"
                                    data-lang="en"
                                  >
                                    English
                                  </a>
                                </li>
                              </ul>
                          </div>
            </div>
          <!-- Menu Bars -->
          <button class="menu-bars">
            <img src="{{ url('public/storage/icons/bars.png') }}" alt="Menu Icon" />
          </button>


        {{-- <!-- side bar -->
        <div class="side-bar-responsive bg-[#FFFFFF] flex gap-[16px] flex-col h-[100vh] text-[32px] w-[300px] absolute top-0 left-[-320px] py-[32px] px-[50px]">
            <a href="./index.html" class="text-[#BBB] nav-link capitalize active">home</a>
            <a href="./product.html" class="text-[#BBB] nav-link capitalize">Products</a>
            <a href="./about-us.html" class="text-[#166E1D] nav-link capitalize">About us</a>
            <a href="./contactus.html" class="text-[#BBB] nav-link capitalize">Contact</a>
            <a href="./blog.html" class="text-[#BBB] nav-link capitalize">Blog</a>
            <a href="./contactus.html" class="contact-button-side outline-none">
              CONTACT US
              <img src="./public/icons/arrow.png" alt="Arrow Icon" />
            </a>
          </div> --}}

           <!-- side bar -->
           <div class="side-bar-responsive bg-[#FFFFFF] flex gap-[16px] flex-col h-[100vh] text-[32px] w-[300px] absolute top-0 left-[-320px] py-[32px] px-[50px]">
            @foreach ($navbarLinks as $navbarLink)
                @if (!in_array($navbarLink->controller_name, ['CareerPageController', 'ContactPageController']))
                    <a href="{{ route('dynamic.page', ['lang' => app()->getLocale() == 'en' ? '' : app()->getLocale(), 'slug' => $navbarLink->slug]) }}"
                       class="nav-link capitalize {{ session('active_navbar_link') === $navbarLink->slug ? 'text-[#166E1D] active' : 'text-[#BBB]' }}">
                        {{ $navbarLink->title }}
                    </a>
                @endif
            @endforeach
            @if (app()->getLocale() == 'en')
            <a href="{{  route('dynamic.page', ['slug' => 'contact-us', 'lang' => '']) }}" class="contact-button-side outline-none">
                Contact Us
            @else
            <a href="{{ route('dynamic.page', ['slug' => 'اتصل-بنا', 'lang' => app()->getLocale()]) }}" class="contact-button-side outline-none">
                تواصل معنا
            @endif
                <img class="arrow-icon" src="{{  url('public/storage/icons/arrow.png') }}" alt="Arrow Icon" />
            </a>
        </div>
        </div>
      </section>
      <!-- nav bar -->
