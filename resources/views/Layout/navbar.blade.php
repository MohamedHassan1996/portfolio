      <!-- nav bar -->

      <section class="navigation-bar" id="header">
        <div class="nav-container">
          <div class="brand-links">
            <!-- Brand Logo -->
            <a href="{{ route('dynamic.page', ['slug' => '', 'lang' => app()->getLocale() == 'en' ? '':app()->getLocale() ]) }}" class="brand">
              <img
                src="{{ url('storage/assets/image_5d73f37c.jpeg') }}"
                alt="Brand"
                class="brand-logo"
              />
            </a>

            <!-- Navigation Links -->
            <div class="nav-links">
                @foreach ($navbarLinks as $navbarLink)
                    @if ($navbarLink->controller_name != 'ContactPageController')</dd>
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
                <img class="arrow-icon" src="{{  url('storage/icons/arrow.png') }}" alt="Arrow Icon" />
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
            <img src="url('storage/icons/bars.png')" alt="Menu Icon" />
          </button>

        </div>
      </section>
      <!-- nav bar -->
