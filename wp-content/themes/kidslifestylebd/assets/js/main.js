document.addEventListener("DOMContentLoaded", () => {
  // Header Nav links
  document.querySelectorAll('.nav-link').forEach(link => {
    if (link.href === window.location.href) {
      link.classList.add('active');
    } else {
      link.classList.remove('active');
    }
  });

  document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
    new bootstrap.Tooltip(el)
  });

  const targetDate = new Date().getTime() + (215 * 24 * 60 * 60 * 1000);

  const countdown = setInterval(() => {
    const now = new Date().getTime();
    const distance = targetDate - now;

    if (distance < 0) {
      clearInterval(countdown);
      document.querySelector("#countdown").innerHTML = "⏰ Time’s up!";
      return;
    }

    // Calculate time
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Update UI
    try {
      document.querySelector("#days").textContent = days.toString().padStart(2, '0');
      document.querySelector("#hours").textContent = hours.toString().padStart(2, '0');
      document.querySelector("#minutes").textContent = minutes.toString().padStart(2, '0');
      document.querySelector("#seconds").textContent = seconds.toString().padStart(2, '0');
    } catch { }
  }, 1000);

  // Button back to top and shrink navbar
  const btnBackToTop = document.querySelector("#btnBackToTop");
  const navbarWrapper = document.querySelector('#navbar');

  // Show/hide button on scroll
  window.addEventListener("scroll", () => {
    if (window.scrollY > 100) {
      btnBackToTop.classList.add('show');
      btnBackToTop.classList.remove('hide');
      navbarWrapper.classList.add('navbar-wrapper');
    } else {
      btnBackToTop.classList.remove('show');
      btnBackToTop.classList.add('hide');
      navbarWrapper.classList.remove('navbar-wrapper');
    }
  });

  // Smooth scroll to top
  try {
    btnBackToTop.addEventListener("click", () => {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  } catch { }

  // Single Product page (Change big image on thumbnail click)
  document.querySelectorAll('.thumb-img').forEach(img => {
    img.addEventListener('click', function () {
      // update main image
      document.querySelector('#mainImage').src = this.src;
      // remove active from all
      document.querySelectorAll('.thumb-img').forEach(i => i.classList.remove('active-thumb'));
      // add active to clicked
      this.classList.add('active-thumb');
    });
  });

  // Single product page // Grab all the tag items
  const weightTags = document.querySelectorAll(".weight-tags p");
  const weightValue = document.querySelector(".weight-value");

  weightTags.forEach(tag => {
    tag.addEventListener("click", () => {
      weightValue.textContent = tag.textContent.replace(" G", ""); // remove G if needed

      weightTags.forEach(t => t.classList.remove("active"));
      tag.classList.add("active");
    });
  });


  // Single product page // Quantity increase and reduce
  const minusBtn = document.querySelector(".minus-btn");
  const plusBtn = document.querySelector(".plus-btn");
  const qtyInput = document.querySelector(".qty-input");

  try {
    plusBtn.addEventListener("click", () => {
      qtyInput.value = parseInt(qtyInput.value) + 1;
    });
    minusBtn.addEventListener("click", () => {
      let currentValue = parseInt(qtyInput.value);
      if (currentValue > 1) {
        qtyInput.value = currentValue - 1;
      }
    });
    //Single product page // Share the product to social media
    document.querySelector("#shareBtn").addEventListener("click", async () => {
      if (navigator.share) {
        try {
          await navigator.share({
            title: document.title,
            text: "Check this out!",
            url: window.location.href
          });
          console.log("Thanks for sharing!");
        } catch (err) {
          console.error("Share failed:", err.message);
        }
      } else {
        // fallback (copy link to clipboard)
        navigator.clipboard.writeText(window.location.href);
        alert("Link copied to clipboard!");
      }
    });
  } catch { }


  // add to cart
  const addToCartBtn = document.querySelector("#addToCartBtn");
  const cartSidebar = document.querySelector("#cartSidebar");
  const cartOverlay = document.querySelector("#cartOverlay");
  const closeCartBtn = document.querySelector("#closeCartBtn");
  const cartItems = document.querySelector("#cartItems");
  const cartCount = document.querySelector("#cartCount");
  const handleDelete = document.querySelector("#deleteProduct");

  let cart = [];

  // Open sidebar
  function openCart() {
    cartSidebar.classList.add("active");
    cartOverlay.classList.add("active");
  }

  // Close sidebar
  function closeCart() {
    cartSidebar.classList.remove("active");
    cartOverlay.classList.remove("active");
  }

  try {
    // Add to Cart button
    addToCartBtn.addEventListener("click", () => {
      const product = { id: Date.now(), img: 'https://toytime-theme.myshopify.com/cdn/shop/products/shop-1.jpg?v=1706620888', name: "Baby Owl", price: "430", color: 'Black', category: 'Polyster', weight: '85g' };
      cart.push(product);
      updateCartUI();
      openCart();
    });
    // Close actions
    closeCartBtn.addEventListener("click", closeCart);
    cartOverlay.addEventListener("click", closeCart);
  } catch { }


  // Update cart UI
  function updateCartUI() {
    cartItems.innerHTML = "";
    cart.forEach(item => {
      const div = document.createElement("div");
      div.classList.add("mb-2", "border-bottom", "pb-2", "w-100");
      div.innerHTML = `
        <div class="d-flex flex-column flex-md-row flex-lg-row justify-content-between align-items-center text-decoration-none gap-2 w-100">
          <div class="d-flex gap-2 align-items-center">
            <div class="w-25"> 
              <img class="img-fluid" src="${item.img}" alt="${item.name}" /> 
            </div> 
            <div class="product-info w-75"> 
              <p class="text-muted">TOY MAKER</p>
              <h5 class="mb-0">${item.name}</h5> 
              <p>${item.color}/${item.category}/${item.weight}</p> 
            </div>
          </div> 
          <div class="d-flex gap-2">
            <div class="product-options"> 
              <div class="d-flex align-items-center quantity"> 
                <button class="minus-btn">-</button> 
                <input type="number" class="qty-input" name="quantity" value="1" min="1"> 
                <button class="plus-btn">+</button> 
              </div> 
            </div> 
            <div> 
              <button id="deleteProduct" class="delete-btn"> 
              <svg xmlns="http://www.w3.org/2000/svg" width="17" height="22" viewBox="0 0 17 22" fill="none"> 
              <path d="M10.9849 21H6.01515C3.76592 21 1.89157 19.2613 1.74163 17.0213L1.0026 6.152C0.959754 5.53333 1.45244 5 2.08436 5H14.9263C15.5476 5 16.0402 5.52267 15.9974 6.14133L15.2584 17.0213C15.1084 19.2613 13.2341 21 10.9849 21Z" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> 
              <path d="M6 16V9" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> 
              <path d="M11 9V16" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> 
              <path d="M1 2H16" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> 
              <path d="M9 2V1" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> 
              </svg> 
              </button> 
            </div>
          </div> 
        </div>
        `;
      cartItems.appendChild(div);
    });
    cartCount.textContent = cart.length;
  }
  // Hero swiper

  // Related Products
  const sliderReroducts = new Swiper('.related-products-slider', {
    slidesPerView: 4,
    loop: true,
    spaceBetween: 15,
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      576: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 3,
      },
      992: {
        slidesPerView: 4,
      },
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    }
  });

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
      300: {
        slidesPerView: 2,
        direction: "horizontal",
      },
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
      1440: {
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
});

