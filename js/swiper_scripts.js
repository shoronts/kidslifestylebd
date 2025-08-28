// Hero swiper

    // Image Swiper (coverflow effect)
    const imageSwiper = new Swiper('.hero-swiper', {
      loop: true,
      speed: 1000,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      effect: 'slide',   // default effect (simple sliding)
      // effect: 'fade',  // cross-fade transition
      // effect: 'cube',  // 3D cube
      // effect: 'coverflow', // 3D coverflow
      // effect: 'flip',  // flipping card effect
    });

    // Category
    const roundedSwiper = new Swiper('.category-swiper', {
        slidesPerView: 1, // default for very small screens
        spaceBetween: 30,
        loop: true,
        breakpoints: {
          480: { slidesPerView: 2 },   // small mobile
          768: { slidesPerView: 3 },   // tablet
          992: { slidesPerView: 4 },   // small desktop
          1200: { slidesPerView: 5 },  // large desktop
        },
        pagination: {
        el: '.swiper-pagination',
        clickable: true, // so user can click the dots
      }
    });

// Cards
const cardSwiper = new Swiper('.card-swiper', {
  loop: true,
  spaceBetween: 20,
  pagination: {
    el: '.card-swiper .swiper-pagination', 
    clickable: true,
  },
  breakpoints: {
    320: { slidesPerView: 1 },   // small devices
    575: { slidesPerView: 2 },
    768: { slidesPerView: 2 },   // tablets
    992: { slidesPerView: 3 },   // desktops
  }
});

// Age Category
  const ageCardSwiper = new Swiper('.age-swiper', {
      slidesPerView: 1, // default for very small screens
      spaceBetween: 30,
      loop: true,
      breakpoints: {
        480: { slidesPerView: 2 },   // small mobile
        768: { slidesPerView: 3 },   // tablet
        992: { slidesPerView: 4 },   // small desktop
        1200: { slidesPerView: 4 },  // large desktop
      },
      pagination: {
      el: '.swiper-pagination',
      clickable: true, // so user can click the dots
    }
  });

  // New arrival 
    const newArrivalSwiper = new Swiper('.newarrival-swiper', {
        slidesPerView: 1, // default for very small screens
        spaceBetween: 30,
        loop: true,
        breakpoints: {
          480: { slidesPerView: 2 },   // small mobile
          768: { slidesPerView: 3 },   // tablet
          992: { slidesPerView: 4 },   // small desktop
          1200: { slidesPerView: 6 },  // large desktop
        },
        pagination: {
        el: '.swiper-pagination',
        clickable: true, // so user can click the dots
      }
    });

  // news 
  const newsSwiper = new Swiper(".news-swiper", {
    loop: false,
    spaceBetween: 30,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      320: { slidesPerView: 1 },
      768: { slidesPerView: 2 },
      992: { slidesPerView: 3 }
    }
  });

  // Brands swiper
    const brandsSwiper = new Swiper('.brands-swiper', {
        slidesPerView: 2, // default for very small screens
        spaceBetween: 30,
        loop: true,
        breakpoints: {
          480: { slidesPerView: 2 },   // small mobile
          768: { slidesPerView: 3 },   // tablet
          992: { slidesPerView: 4 },   // small desktop
          1200: { slidesPerView: 5 },  // large desktop
        }
    });


    