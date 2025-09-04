// Hero swiper

    // Image Swiper (coverflow effect)
    const imageSwiper = new Swiper('.hero-swiper', {
      loop: true,
      speed: 1000,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      effect: 'slide',
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

  // Home page // Brands swiper
    const brandsSwiper = new Swiper('.brands-swiper', {
        slidesPerView: 2, 
        spaceBetween: 30,
        loop: true,
        breakpoints: {
          480: { slidesPerView: 2 },   
          768: { slidesPerView: 3 },   
          992: { slidesPerView: 4 },   
          1200: { slidesPerView: 5 },  
        }
    });


  // Single product page // Product image thumbs
  const thumbSwiper = new Swiper(".productThumbs", {
    direction: "vertical", 
    slidesPerView: 3,
    spaceBetween: 20,
    breakpoints: {
      480: {
        direction: "horizontal",
        slidesPerView: 3
      },
      768: {
        direction: "horizontal",
        slidesPerView: 4
      },
      992: {
        slidesPerView: 4
      },
      992: {
        direction: "vertical", 
        slidesPerView: 3
      },
      1440:{
        direction: "vertical", 
        slidesPerView: 3
      }
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

  // Single product page // Reccomended products
    const reccomendedSwiper = new Swiper('.reccomended-swiper', {
        slidesPerView: 1, // default for very small screens
        spaceBetween: 30,
        loop: true,
        autoplay: {
        delay: 2000,
        disableOnInteraction: false,
      },
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

    // About page / Fabrics slider
const fabricsSwiper = new Swiper('.fabrics-swiper', {
  loop: false,
  spaceBetween: 20,
  pagination: {
    el: '.card-swiper .swiper-pagination', 
    clickable: true,
  },
  autoplay: {
    delay: 2000,
    disableOnInteraction: false,
  },
  breakpoints: {
    320: { slidesPerView: 1 },   // small devices
    575: { slidesPerView: 2 },
    768: { slidesPerView: 2 },   // tablets
    992: { slidesPerView: 3 },   // desktops
  }
});

// About page // Testimonials
var testimonialSwiper = new Swiper(".testimonialSwiper", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    autoplay: {
    delay: 2000,
    disableOnInteraction: false,
  },
  });

  // About page / Our team slider
const ourTeamSwiper = new Swiper('.our-team-swiper', {
  loop: false,
  spaceBetween: 20,
  autoplay: {
    delay: 2000,
    disableOnInteraction: false,
  },
  breakpoints: {
    320: { slidesPerView: 2 },   // small devices
    575: { slidesPerView: 2 },
    768: { slidesPerView: 3 },   // tablets
    992: { slidesPerView: 4 },   // desktops
  }
});

// About page / Social slider
const socialSwiper = new Swiper('.social-swiper', {
  loop: false,
  spaceBetween: 20,
  autoplay: {
    delay: 2000,
    disableOnInteraction: false,
  },
  breakpoints: {
    320: { slidesPerView: 2 },   // small devices
    575: { slidesPerView: 2 },
    768: { slidesPerView: 3 },   // tablets
    992: { slidesPerView: 4 },   // desktops
  }
});


    