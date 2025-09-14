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
      document.getElementById("countdown").innerHTML = "⏰ Time’s up!";
      return;
    }

    // Calculate time
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Update UI
    document.getElementById("days").textContent = days.toString().padStart(2, '0');
    document.getElementById("hours").textContent = hours.toString().padStart(2, '0');
    document.getElementById("minutes").textContent = minutes.toString().padStart(2, '0');
    document.getElementById("seconds").textContent = seconds.toString().padStart(2, '0');
  }, 1000);

  // Button back to top and shrink navbar
  const btnBackToTop = document.getElementById("btnBackToTop");
  const navbarWrapper = document.getElementById('navbar');

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
    btnBackToTop.addEventListener("click", () => {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });

    // Single Product page (Change big image on thumbnail click)
    document.querySelectorAll('.thumb-img').forEach(img => {
      img.addEventListener('click', function () {
        // update main image
        document.getElementById('mainImage').src = this.src;
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
    document.getElementById("shareBtn").addEventListener("click", async () => {
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

    // add to cart
    const addToCartBtn = document.getElementById("addToCartBtn");
    const cartSidebar = document.getElementById("cartSidebar");
    const cartOverlay = document.getElementById("cartOverlay");
    const closeCartBtn = document.getElementById("closeCartBtn");
    const cartItems = document.getElementById("cartItems");
    const cartCount = document.getElementById("cartCount");
    const handleDelete = document.getElementById("deleteProduct");

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

    // Add to Cart button
    addToCartBtn.addEventListener("click", () => {
      const product = { id: Date.now(), img: 'https://toytime-theme.myshopify.com/cdn/shop/products/shop-1.jpg?v=1706620888', name: "Baby Owl", price: "430", color:'Black', category:'Polyster', weight:'85g' };
      cart.push(product);
      updateCartUI();
      openCart();
    });

    // Close actions
    closeCartBtn.addEventListener("click", closeCart);
    cartOverlay.addEventListener("click", closeCart);

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

    // handleDelete.addEventListener('click', () =>{
    //   console.log(`${item.name} Deleted`);
    // })
});

