document.addEventListener('DOMContentLoaded', () => {
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

  // Button back to top
  const btnBackToTop = document.getElementById("btnBackToTop");

  // Show/hide button on scroll
  window.addEventListener("scroll", () => {
    if (window.scrollY > 300) {
      btnBackToTop.classList.add('show');
      btnBackToTop.classList.remove('hide');
    } else {
      btnBackToTop.classList.remove('show');
      btnBackToTop.classList.add('hide');
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
  document.addEventListener("DOMContentLoaded", () => {
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
});