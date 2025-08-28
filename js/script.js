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