<!-- footer -->
<section class="footer bg-[#333333] py-[64px]">
    <div class="w-11/12 md:w-4/5 m-auto">
      <div class="flex gap-[64px] flex-wrap ">
        <div class="w-[450px] flex flex-col gap-[28px]">
          <img src="{{ url('public/storage/assets/image_5d73f37c.jpeg') }}" width="70" height="50" alt="logo image" />

          <div class="address">
            <div class="title items-stretch font-semibold text-[#FBFCF8] mt-1">{{ app()->getLocale() == 'en' ? 'Address:' : 'العنوان:' }}</div>

            @if(app()->getLocale() == 'en')
            <p class="text-[#FBFCF8] font-[100]">Behind Sindoub Insurance Hospital, above Basmala Center for Physiotherapy , Mansoura, Egypt</p>
            @else
            <p class="text-[#FBFCF8] font-[400]">خلف مستشفى التأمين بسندوب، فوق مركز بسملة للاستشفاء الطبي، المنصورة، مصر</p>
            @endif
          </div>

          <div class="contact">
            <div class="title items-stretch font-semibold text-[#FBFCF8]">{{ app()->getLocale() == 'en' ? 'Contact:' : 'اتصل بنا:' }}</div>
            <a href="tel:01069166696" class="text-[#FBFCF8] font-[100] mt-1">
                <bdi>010 69166696</bdi>
            </a>
            <br>
            <a href="mailto:mbopharma2019@gmail.com" class="text-[#FBFCF8] font-[100] mt-1">
                mbopharma2019@gmail.com
            </a>
          </div>

          <div class="social-media-icons flex gap-[12px]">
            <a href="https://www.facebook.com/mbopharma" target="_blank"><img src="{{ url('public/storage/assets/Facebook.png') }}" width="25" height="25" alt="Facebook" /></a>
            <a href="https://www.instagram.com/mbopharma2019" target="_blank"><img src="{{ url('public/storage/assets/Instagram.png') }}" width="25" height="25" alt="Instagram" /></a>
            <a href="https://www.linkedin.com/company/mbopharma" target="_blank"><img src="{{ url('public/storage/assets/LinkedIn.png') }}" width="25" height="25" alt="LinkedIn" /></a>
            {{-- <a href="https://twitter.com" target="_blank"><img src="{{ url('public/storage/assets/X.png') }}" width="25" height="25" alt="Twitter" /></a> --}}
            {{-- <a href="https://www.youtube.com" target="_blank"><img src="{{ url('public/storage/assets/Youtube.svg') }}" width="25" height="25" alt="YouTube"/></a> --}}
          </div>
        </div>

        <div class="flex flex-col gap-[16px] w-[100px]">
            @foreach ($navbarLinks as $navbarLink)
                @if (!in_array($navbarLink->controller_name, ['CareerPageController', 'ContactPageController']))
                    <a href="{{ route('dynamic.page', ['lang' => app()->getLocale() == 'en' ? '':app()->getLocale(), 'slug' => $navbarLink->slug]) }}"
                           class="[font-family:'Open_Sans',sans-serif] text-[18px] text-base font-normal leading-4 text-[#FBFCF8] cursor-pointer {{ session('active_navbar_link') === $navbarLink->slug ? 'active' : '' }}">
                            {{ $navbarLink->title }}
                        </a>
                    @endif
                @endforeach
        </div>

        <div class="SubscribeForm w-[450px] sm:mb-[250px]">
          <form class="Subscribe flex flex-col sm:flex-row gap-5 mb-6">
            <input type="email" required name="email" id="email" class="w-full p-[12px] outline-none border border-white bg-transparent rounded-[2px] text-[white]" placeholder="{{ app()->getLocale() == 'en' ? 'Enter your email' : 'أدخل بريدك الإلكتروني' }}" />
            <button class="bg-[#EA5212] text-[white] rounded-[4px] px-[12px] h-[48px] outline-none" type="submit">{{ app()->getLocale() == 'en' ? 'Subscribe' : 'اشترك' }}</button>
          </form>
          <p class="text-[white] [font-family: Montserrat] font-[400] text-[16px]">
            {{ app()->getLocale() == 'en' ? 'By subscribing you agree to with our Privacy Policy and provide
            consent to receive updates from our company' : 'بالتسجيل، أنا أوافق على سياسة الخصوصية الخاصة بنا والموافقة على استقبال التحديثات من شركتنا' }}
          </p>
        </div>
      </div>
      <div  class="text-center mt-6 border-t pt-[32px] flex items-center justify-between flex-wrap-reverse border-[#FBFCF8]">
        <p class="text-[#FBFCF8] text-[14px]">
            @if (app()->getLocale() == 'en')
                <bdi>© 2025 MBO pharma. All rights reserved.</bdi>
            @else
                <bdi>© 2025 MBO pharma. جميع الحقوق محفوظة.</bdi>
            @endif
        </p>
        <!--<div class="links flex flex-col gap-[24px] md:flex-row">
          <a href="" class="text-white">Privacy Policy</a>
          <a href="" class="text-white">Terms of Service</a>
          <a href="" class="text-white">Cookies Settings</a>
        </div>-->
      </div>
    </div>
  </section>
  @vite(['resources/js/app.js'])
  <script>
   document.querySelector('.Subscribe').addEventListener('submit', async (event) => {
  event.preventDefault(); // Prevent form default submission
  console.log('Form submitted');

  const email = document.getElementById('email').value;

  if (!email) {
    displayPopup('Please enter a valid email address.', false);
    return;
  }

  // Show overlay with loading spinner
  showLoadingOverlay();

  try {
    const response = await fetch('{{ url('/') }}/api/v1/subscribers/create', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        email: email,
        isSubscribed: 1,
      }),
    });

    if (response.ok) {
      const result = await response.json();
      displayPopup('Subscription successful. Thank you for subscribing!', true);
      document.getElementById('email').value = ''; // Clear the input field
    } else {
      if (response.status === 401) {
        displayPopup('You are already subscribed.', false);
      } else {
        displayPopup('Failed to subscribe. Please try again later.', false);
      }
    }
  } catch (error) {
    console.error('Error:', error);
    displayPopup('An error occurred. Please try again later.', false);
  } finally {
    // Hide the overlay after the response or error
    hideLoadingOverlay();
  }
});

function displayPopup(message, isSuccess) {
  const popup = document.createElement('div');
  popup.className = 'custom-popup';
  popup.style.position = 'fixed';
  popup.style.top = '50%';
  popup.style.left = '50%';
  popup.style.transform = 'translate(-50%, -50%)';
  popup.style.padding = '20px';
  popup.style.backgroundColor = isSuccess ? '#4CAF50' : '#f44336';
  popup.style.color = 'white';
  popup.style.borderRadius = '8px';
  popup.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
  popup.style.zIndex = 10000;
  popup.innerHTML = `
    <p style="margin: 0;">${message}</p>
    <button style="margin-top: 10px; padding: 8px 12px; border: none; background: white; color: ${isSuccess ? '#4CAF50' : '#f44336'}; border-radius: 4px; cursor: pointer;">
      OK
    </button>
  `;
  document.body.appendChild(popup);

  const closeButton = popup.querySelector('button');
  closeButton.addEventListener('click', () => {
    popup.remove();
  });
}

function showLoadingOverlay() {
  const overlay = document.createElement('div');
  overlay.id = 'loading-overlay';
  overlay.style.position = 'fixed';
  overlay.style.top = 0;
  overlay.style.left = 0;
  overlay.style.width = '100vw';
  overlay.style.height = '100vh';
  overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
  overlay.style.display = 'flex';
  overlay.style.justifyContent = 'center';
  overlay.style.alignItems = 'center';
  overlay.style.zIndex = 9999;

  overlay.innerHTML = `
    <div style="border: 4px solid #f3f3f3; border-top: 4px solid #3498db; border-radius: 50%; width: 50px; height: 50px; animation: spin 1s linear infinite;"></div>
    <style>
      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }
    </style>
  `;

  document.body.appendChild(overlay);
}

function hideLoadingOverlay() {
  const overlay = document.getElementById('loading-overlay');
  if (overlay) {
    overlay.remove();
  }
}

  </script>

    </body>
</html>
