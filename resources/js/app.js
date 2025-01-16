import './bootstrap';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';
window.Swiper = Swiper;
document.addEventListener("DOMContentLoaded", () => {
    const header = document.getElementById("header");
    console.log(typeof Swiper);

    const handleScroll = () => {
      if (window.scrollY > 0) {
        header.classList.add("pinned");
      } else {
        header.classList.remove("pinned");
      }
    };
    window.addEventListener("scroll", handleScroll);

    window.toggleButton = (button) => {
      const buttons = document.querySelectorAll(".toggle-bg");
      buttons.forEach((btn) => {
        btn.classList.remove("bg-[#166e1d]", "text-white");
        btn.classList.add("text-black");
      });
      button.classList.add("bg-[#166e1d]", "text-white");
      button.classList.remove("text-black");
    };

    const CountersOnScroll = () => {
        const counters = document.querySelectorAll('[class^="stats-counter"]'); // Select all elements starting with "stats-counter"

        const updateCounters = () => {
            counters.forEach((counter) => {
                const sectionTop = counter.getBoundingClientRect().top + window.scrollY;
                const scrollThreshold = sectionTop - window.innerHeight * 0.6;

                // Check if counter is in the viewport
                if (window.scrollY >= scrollThreshold && !counter.classList.contains('counted')) {
                    let count = 0;
                    const target = parseInt(counter.textContent, 10); // Get initial number from HTML
                    const totalDuration = 2000; // Animation duration in ms
                    const increment = target / (totalDuration / 16); // Increment per frame (assuming 60fps)

                    const updateCounter = () => {
                        if (count < target) {
                            count += increment;
                            if (count > target) count = target;
                            counter.textContent = Math.floor(count);
                            requestAnimationFrame(updateCounter);
                        } else {
                            counter.classList.add('counted'); // Mark the counter as completed
                        }
                    };

                    updateCounter(); // Start counting animation
                }
            });
        };

        // Bind scroll event
        window.addEventListener('scroll', updateCounters);

        // Trigger an initial update in case the counters are already in view when the page loads
        updateCounters();
    };

    CountersOnScroll(); // Call the function to initialize

    const NAVBAR = document.querySelector(".menu-bars");
    NAVBAR.addEventListener("click", () => {
      const SIDEBAR_RESPONSIVE = document.querySelector(".side-bar-responsive");
      SIDEBAR_RESPONSIVE.classList.toggle("active");
    });

    window.toggleAnswer = (element) => {
      const PARENT = element.parentElement;
      const ANSWER = PARENT.querySelector(".faq-answer");
      const ICON = PARENT.querySelector(".icon");

      if (ANSWER.classList.contains("hidden")) {
        ANSWER.classList.remove("hidden");
        ANSWER.classList.add("visible", "activeQuestion");
        ICON.src = "https://mbopharma.com/public/storage/icons/minus.svg";
        element.style.borderTop = "1px solid #333";
        element.style.borderRight = "1px solid #333";
        element.style.borderLeft = "1px solid #333";
        element.style.borderRadius = "8px 8px 0px 0px";
        element.style.backgroundColor = "#3333330A";
      } else {
        ANSWER.classList.remove("visible", "activeQuestion");
        ANSWER.classList.add("hidden");
        ICON.src = "https://mbopharma.com/public/storage/icons/plus.svg";
        element.style.border = "none";
        element.style.backgroundColor = "#fff";
      }
    };

    // const customSelect = document.querySelector(".custom-select");
    // const selectedOption = customSelect.querySelector(".selected-option");
    // const options = customSelect.querySelector(".options");

    // customSelect.addEventListener("click", () => {
    //   customSelect.classList.toggle("open");
    // });

    // options.addEventListener("click", (event) => {
    //   if (event.target.tagName === "LI" || event.target.closest("li")) {
    //     const li = event.target.tagName === "LI" ? event.target : event.target.closest("li");
    //     const value = li.getAttribute("data-value");
    //     const img = li.querySelector("img").src;
    //     const text = li.textContent.trim();

    //     selectedOption.innerHTML = `<img src="${img}" alt="${text} Flag" class="flag-icon" /> ${text}`;
    //     customSelect.classList.remove("open");
    //   }
    // });

    // document.addEventListener("click", (event) => {
    //   !customSelect.contains(event.target) ? customSelect.classList.remove("open") : null;
    // });

    // document.querySelectorAll('.language-picker').forEach((element) => {
    //     element.addEventListener('click', (event) => {
    //         event.preventDefault(); // Prevent default anchor behavior

    //         const lang = element.getAttribute('data-lang');
    //         const currentUrl = new URL(window.location.href); // Get the current URL
    //         const pathname = currentUrl.pathname;
    //         const queryParams = currentUrl.search; // Preserve query parameters if any
    //         const segments = pathname.split('/').filter(segment => segment !== ''); // Split URL into segments

    //         // Determine if the first segment is a language code
    //         const supportedLangs = ['ar', 'en', 'fr', 'es'];
    //         let currentLang = supportedLangs.includes(segments[0]) ? segments.shift() : 'en';

    //         // Replace the language segment or add it as the first segment
    //         if (lang !== currentLang) {
    //             const newPath = lang === 'en' ? `/${segments.join('/')}` : `/${lang}/${segments.join('/')}`;
    //             const newUrl = `${currentUrl.origin}${newPath}${queryParams}`;
    //             window.location.href = newUrl;
    //         }

    //         // Update HTML attributes for direction and language
    //         const htmlElement = document.documentElement;
    //         const body = document.body;
    //         if (lang === 'en') {
    //             body.classList.remove('rtl');
    //             htmlElement.setAttribute('dir', 'ltr');
    //             htmlElement.setAttribute('lang', 'en');
    //         } else {
    //             body.classList.add('rtl');
    //             htmlElement.setAttribute('dir', 'rtl');
    //             htmlElement.setAttribute('lang', lang);
    //         }
    //     });
    // });

    const customSelect = document.querySelector(".custom-select");
    const selectedOption = customSelect.querySelector(".selected-option");
    const options = customSelect.querySelector(".options");
    console.log(options);

    // Get the saved language from localStorage
    const savedLang = localStorage.getItem("selectedLanguage") || "en";
    updateSelectedLanguage(savedLang);

    customSelect.addEventListener("click", () => {
      customSelect.classList.toggle("open");
    });

    options.addEventListener("click", (event) => {
        console.log(event.target);
      if (event.target.tagName === "LI" || event.target.closest("li")) {
        const li = event.target.tagName === "LI" ? event.target : event.target.closest("li");
        const value = li.getAttribute("data-value");
        const img = li.querySelector("img").src;
        const text = li.textContent.trim();

        // Update selected option
        selectedOption.innerHTML = `<img src="${img}" alt="${text} Flag" class="flag-icon" /> ${text}`;
        customSelect.classList.remove("open");

        // Save selected language to localStorage
        localStorage.setItem("selectedLanguage", value);

        // Update active class
        updateActiveOption(value);
      }
    });

    document.addEventListener("click", (event) => {
      !customSelect.contains(event.target) ? customSelect.classList.remove("open") : null;
    });

    document.querySelectorAll('.language-picker').forEach((element) => {
      element.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent default anchor behavior

        const lang = element.getAttribute("data-lang");
        const currentUrl = new URL(window.location.href); // Get the current URL
        const pathname = currentUrl.pathname;
        const queryParams = currentUrl.search; // Preserve query parameters if any
        const segments = pathname.split("/").filter(segment => segment !== ""); // Split URL into segments

        // Determine if the first segment is a language code
        const supportedLangs = ["ar", "en", "fr", "es"];
        let currentLang = supportedLangs.includes(segments[0]) ? segments.shift() : "en";

        // Replace the language segment or add it as the first segment
        if (lang !== currentLang) {
          const newPath = lang === "en" ? `/${segments.join("/")}` : `/${lang}/${segments.join("/")}`;
          const newUrl = `${currentUrl.origin}${newPath}${queryParams}`;
          window.location.href = newUrl;
        }

        // Update HTML attributes for direction and language
        const htmlElement = document.documentElement;
        const body = document.body;
        if (lang === "en") {
          body.classList.remove("rtl");
          htmlElement.setAttribute("dir", "ltr");
          htmlElement.setAttribute("lang", "en");
        } else {
          body.classList.add("rtl");
          htmlElement.setAttribute("dir", "rtl");
          htmlElement.setAttribute("lang", lang);
        }
      });
    });

    // Function to update active language option
    function updateActiveOption(lang) {
      options.querySelectorAll("li").forEach((li) => {
        li.classList.toggle("active", li.getAttribute("data-value") === lang);
      });
    }

    // Function to update the selected language in UI
    function updateSelectedLanguage(lang) {
      const activeOption = options.querySelector(`li[data-value="${lang}"]`);
      if (activeOption) {
        const img = activeOption.querySelector("img").src;
        const text = activeOption.textContent.trim();
        selectedOption.innerHTML = `<img src="${img}" alt="${text} Flag" class="flag-icon" /> ${text}`;
        updateActiveOption(lang);
      }
    }


    let swiper = new Swiper(".mySwiper", {
      effect: "coverflow",
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      slidesPerView: 3,
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 0.8,
        slideShadows: false,
      },
      breakpoints: {
        640: {
          effect: "slide",
          slidesPerView: 1,
        },
        768: {
          effect: "coverflow",
          slidesPerView: 2,
          coverflowEffect: {
            rotate: 40,
            depth: 150,
          },
        },
        1280: {
          slidesPerView: 3,
        },
      },
      navigation: {
        nextEl: ".next-btn",
        prevEl: ".prev-btn",
        disabledClass: "swiper-button-disabled",
      },
      pagination: {
        el: ".swiper-pagination",
      },
    });

    let swiper_partner = new Swiper(".partner-mySwiper", {
      autoplay: {
        delay: 300,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
        reverseDirection: true,
        speed: 500,
      },
      spaceBetween: 20,
      slidesPerView: 5,
      loop: true,
      breakpoints: {
        640: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 4,
        },
        1280: {
          slidesPerView: 5,
        },
      },
    });

    // contact form





  });


