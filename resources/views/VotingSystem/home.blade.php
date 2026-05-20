<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Home Page</title>

  <!-- Google Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

  <!-- External CSS -->
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>

<header class="top-bar">
  <div class="menu-icon">
    <img src="Images/logo.png" alt="Logo">
    <div class="logo-container">
  <div class="logo" style="font-size:17px; margin-right: 50px; font-weight:600; letter-spacing:0.4px; color:#0f4c4c; text-shadow:0 1px 6px rgba(0,0,0,0.05);">University of Computer Studies (Thaton)</div>
  <div class="logo-particles"></div>
</div>
  <a href="{{asset('event  ')}}">
    <div class="user-area mobile-user">
      <span class="material-symbols-outlined">event_available</span></a>
    </div>
    </a>
  </div>

<div class="event-title">
    Fresher Welcome (2025–2026 AY)
  </div>

  <nav class="sub-nav-links" id="navLinks">
    <a href="#" class="active">Home</a>
    <span>•</span>
    <a href="king_selection">King</a>
    <span>•</span>
    <a href="queen_selection">Queen</a>
  </nav>
</header>

<section class="ranking-section">
  <div class="ranking-container">
    <div class="contest-card">
      <div class="slider">
        <img src="Images/Couple/C1.jpg" data-left="Mg Aung Kaung Myat Paing" data-right="Ma Thain Mwae Thu" data-rank="1">
        <img src="Images/Couple/C2.jpg" data-left="Mg Paing Zay Htut" data-right="Ma Myat Noe Eain" data-rank="2">
        <img src="Images/Couple/C3.jpg" data-left="Ma Chit Myat Noo" data-right="Mg Khant Pyae Hlyan Nyein" data-rank="3">
        <img src="Images/Couple/C4.jpg" data-left="Khun Aung Myat Bhone" data-right="Ma Myat Thiri Ko" data-rank="4">
        <img src="Images/Couple/C5.jpg" data-left="Saw Aung Kaung Myat" data-right="Ma Ei Tha Zin" data-rank="5">
        <img src="Images/Couple/C6.jpg" data-left="Mg Bhone Myat Min Khant" data-right="Ma Htet Htet Win Hlan" data-rank="6">
        <img src="Images/Couple/C7.jpg" data-left="Ma Ingyin Pwint" data-right="Mg Arkar Phyo" data-rank="7">

        <div class="slider-dots"></div>
      </div>

      <div class="card-body">
        <div class="name-pair">
          <h3 id="leftName"></h3>
          <h3 id="rightName"></h3>
        </div>
        <div class="rank-badge rank-badge-floating" id="rankBadge"></div>

      </div>

    </div>
  </div>
</section>
<!-- FOOTER -->
<footer class="sponsor-footer">
  <div class="sponsor-container">

    <p class="sponsor-label">Main Sponsors</p>
    <div class="sponsor-logos">
      <img src="{{asset('images/kbz.jpg')}}" alt="Mytel Logo">
      <img src="{{asset('images/aya.jpg')}}" alt="KBZ Logo">
      <img src="{{asset('images/hairartist.jpg')}}" alt="AYA Logo">
    </div>


  </div>
</footer>
<script>

document.querySelectorAll(".slider").forEach(slider => {
  const slides = slider.querySelectorAll("img");
  const dotsContainer = slider.querySelector(".slider-dots");

  const leftName = document.getElementById("leftName");
  const rightName = document.getElementById("rightName");
  const rankBadge = document.getElementById("rankBadge");

  let currentIndex = 0;
  let startX = 0;
  let currentX = 0;
  let isDragging = false;

  slides.forEach((_, i) => {
    const dot = document.createElement("span");
    if (i === 0) dot.classList.add("active");
    dot.addEventListener("click", () => {
      currentIndex = i;
      updateSlides();
      updateInfo();
    });
    dotsContainer.appendChild(dot);
  });

  const dots = dotsContainer.querySelectorAll("span");

  slides.forEach((img, i) => {
    img.style.transform = `translateX(${i * 100}%)`;
  });

  function updateSlides(offset = 0) {
    slides.forEach((img, i) => {
      img.style.transform = `translateX(${(i - currentIndex) * 100 + offset}%)`;
    });
    dots.forEach((dot, i) => dot.classList.toggle("active", i === currentIndex));
  }

  function updateInfo() {
    const active = slides[currentIndex];
    leftName.textContent = active.dataset.left;
    rightName.textContent = active.dataset.right;
    rankBadge.textContent = active.dataset.rank;
  }

  function startDrag(x) {
    startX = x;
    isDragging = true;
  }

  function onDrag(x) {
    if (!isDragging) return;
    currentX = x - startX;
    const percent = (currentX / slider.offsetWidth) * 100;
    updateSlides(percent);
  }

  function endDrag() {
    if (!isDragging) return;
    isDragging = false;

    const threshold = slider.offsetWidth * 0.25;
    if (currentX < -threshold && currentIndex < slides.length - 1) currentIndex++;
    else if (currentX > threshold && currentIndex > 0) currentIndex--;

    updateSlides();
    updateInfo();
    currentX = 0;
  }

  updateInfo();

  slider.addEventListener("mousedown", e => startDrag(e.clientX));
  window.addEventListener("mousemove", e => onDrag(e.clientX));
  window.addEventListener("mouseup", endDrag);

  slider.addEventListener("touchstart", e => startDrag(e.touches[0].clientX));
  slider.addEventListener("touchmove", e => onDrag(e.touches[0].clientX));
  slider.addEventListener("touchend", endDrag);
});

// Active menu link
</script>

</body>
</html>
