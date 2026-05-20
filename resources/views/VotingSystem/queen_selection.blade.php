<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Queen Selection Page</title>

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/king_selection.css') }}">
<style>
/* ===== MODAL STYLE ===== */
.modal { display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:999; }
.modal-content { background:#fff; padding:20px; border-radius:10px; max-width:400px; width:90%; text-align:center; }
.modal-actions { display:flex; justify-content:space-around; margin-top:15px; }
.done-voting-modal-content { font-size:16px; }
.loading-animation { display:flex; justify-content:center; align-items:center; gap:5px; }
.loading-animation div { width:8px; height:8px; background:#333; border-radius:50%; animation:loadingAnim 1s infinite alternate; }
.loading-animation div:nth-child(2) { animation-delay:0.2s; }
.loading-animation div:nth-child(3) { animation-delay:0.4s; }
.loading-animation div:nth-child(4) { animation-delay:0.6s; }
.loading-animation div:nth-child(5) { animation-delay:0.8s; }
@keyframes loadingAnim { 0% { transform:translateY(0); } 100% { transform:translateY(-10px); } }
.slider-dots { text-align:center; margin-top:5px; }
.slider-dots span { display:inline-block; width:8px; height:8px; border-radius:50%; background:#ccc; margin:0 2px; cursor:pointer; }
.slider-dots .active { background:#333; }
</style>
</head>
<body>

<header class="top-bar">
  <div class="menu-icon">
    <img src="Images/logo.png" alt="Logo" style="width:50px;">
    <div class="logo-container"><div class="logo">University of Computer Studies (Thaton)</div></div>
  </div>
  <nav class="sub-nav-links">
    <a href="{{ asset('home') }}">Home</a>
    <span>•</span>
    <a href="{{ asset('king_selection') }}" >King</a>
    <span>•</span>
    <a href="#"class="active">Queen</a>
  </nav>
</header>

@php
$loginCode = session('login_code');
$currentUser = \App\Models\User::where('login_code', $loginCode)->first();
@endphp

<section class="ranking-section">
<div class="ranking-container">

@foreach ($queens as $queen)
<div class="contest-card second">
  <div class="slider">
    @php $queenImages = $queen->images->take(3); @endphp
    @foreach ($queenImages as $image)
      <a href="{{ url('queen/'.$queen->sel_id.'?img='.$image->img_id) }}">
        <img src="{{ asset($image->image_url) }}" alt="{{ $queen->name }}">
      </a>
    @endforeach
    <div class="slider-dots"></div>
  </div>

  <div class="card-body" style="height:auto;">
    <div class="name-pair">
      <h3 class="left-name">{{ $queen->name }}</h3>
      <div class="rank-badge">{{ $queen->number }}</div>
    </div>

    <div class="votebutton">
      <form method="POST" action="{{ route('vote.queen', ['id' => $queen->sel_id]) }}">
        @csrf
        <button type="button" class="vote1 vote-btn"
          data-queen-name="{{ $queen->name }}"
          data-logged-in="{{ $loginCode ? '1' : '0' }}"
          @if($currentUser && $currentUser->qflag == 0) disabled @endif
        >Vote</button>
      </form>
    </div>
  </div>
</div>
<div class="card-divider"></div>
@endforeach

</div>
</section>

<!-- CONFIRM VOTE MODAL -->
<div id="voteConfirmModal" class="modal">
  <div class="modal-content">
    <h3>Confirm Vote</h3>
    <p id="voteConfirmText"></p>
    <div class="modal-actions">
      <button id="cancelVote">Cancel</button>
      <button id="confirmVote">OK</button>
    </div>
  </div>
</div>

<!-- LOGIN MODAL -->
<div id="loginModal" class="modal">
  <div class="modal-content">
    <p id="errorLogin" style="color:red; display:none;"></p>
    <input type="text" id="loginCode" placeholder="Enter Voting Code">
    <div class="modal-actions">
      <button type="button" id="closeLogin">Cancel</button>
      <button type="button" id="loginSubmit">Login</button>
    </div>
  </div>
</div>

<!-- LOADING MODAL -->
<div id="loadingModal" class="modal">
  <div class="modal-content" style="background:transparent; box-shadow:none;">
    <div id="loaderContent" class="loading-animation">
      <div></div><div></div><div></div><div></div><div></div>
    </div>
  </div>
</div>

<!-- DONE VOTING MODAL -->
<div id="doneVotingModal" class="modal">
  <div class="modal-content done-voting-modal-content">
    <h3>Success 🎉</h3>
    <p id="doneVotingText"></p>
  </div>
</div>

<script>
// ===== VOTE BUTTON LOGIC =====
let selectedForm = null;
let pendingQueenName = '';

document.querySelectorAll('.vote-btn').forEach(btn => {
  btn.onclick = function() {
    if(this.disabled) return;
    selectedForm = this.closest('form');
    pendingQueenName = this.dataset.queenName;
    if(this.dataset.loggedIn === "1") {
      showConfirm(pendingQueenName);
    } else {
      document.getElementById('loginModal').style.display = 'flex';
    }
  }
});

function showConfirm(name) {
  document.getElementById('voteConfirmText').innerText = `Vote to (${name})?`;
  document.getElementById('voteConfirmModal').style.display = 'flex';
}

document.getElementById('confirmVote').onclick = () => {
  document.getElementById('voteConfirmModal').style.display = 'none';
  showLoading();
  selectedForm.submit();
};
document.getElementById('cancelVote').onclick = () => {
  document.getElementById('voteConfirmModal').style.display = 'none';
};

// ===== LOGIN LOGIC =====
const loginSubmit = document.getElementById('loginSubmit');
const loginCodeInput = document.getElementById('loginCode');
const errorLogin = document.getElementById('errorLogin');
const loginModal = document.getElementById('loginModal');
const loadingModal = document.getElementById('loadingModal');
const loaderContent = document.getElementById('loaderContent');
const closeLogin = document.getElementById('closeLogin');

loginSubmit.onclick = function() {
  const code = loginCodeInput.value.trim();
  if(!code){ errorLogin.innerText="Please enter your login code"; errorLogin.style.display="block"; return;}
  errorLogin.style.display="none"; loginModal.style.display="none";
  showLoading();

  const formData = new FormData();
  formData.append('login_code', code);

  fetch("{{ url('/login') }}", {
    method:"POST",
    headers:{"X-CSRF-TOKEN":"{{ csrf_token() }}"},
    body: formData
  }).then(res=>res.json()).then(data=>{
    hideLoading();
    if(data.status==='success'){
      showConfirm(pendingQueenName);
    } else {
      errorLogin.innerText = data.message || "Login Failed"; errorLogin.style.display="block"; loginModal.style.display='flex';
    }
  }).catch(()=>{ hideLoading(); errorLogin.innerText="Login Failed"; errorLogin.style.display="block"; loginModal.style.display='flex'; });
};

closeLogin.onclick = () => loginModal.style.display='none';

// ===== LOADING FUNCTIONS =====
function showLoading(){ loaderContent.className='loading-animation'; loadingModal.style.display='flex'; }
function hideLoading(){ loadingModal.style.display='none'; }

// ===== SUCCESS MODAL AFTER REDIRECT =====
@if(session('vote_success'))
window.onload = function(){
  document.getElementById('doneVotingText').innerText='Voted to {{ session("vote_success") }}';
  document.getElementById('doneVotingModal').style.display='flex';
  setTimeout(()=>{ document.getElementById('doneVotingModal').style.display='none'; window.location.reload(); }, 2000);
};
@endif

// ===== IMAGE SLIDER =====
document.querySelectorAll('.contest-card .slider').forEach(slider=>{
  const slides = slider.querySelectorAll('img');
  const totalSlides = slides.length;
  let currentIndex=0,startX=0,currentX=0,isDragging=false;

  const dotsContainer=slider.querySelector('.slider-dots');
  slides.forEach((_,i)=>{
    const dot=document.createElement('span');
    if(i===0) dot.classList.add('active');
    dot.addEventListener('click',()=>{ currentIndex=i; updateSlides(); });
    dotsContainer.appendChild(dot);
  });
  const dots=dotsContainer.querySelectorAll('span');
  slides.forEach((img,i)=>{ img.style.transform=`translateX(${i*100}%)`; img.style.transition='transform 0.3s ease'; });

  function updateSlides(offset=0){
    slides.forEach((img,i)=> img.style.transform=`translateX(${(i-currentIndex)*100+offset}%)`);
    dots.forEach((dot,i)=>dot.classList.toggle('active',i===currentIndex));
  }

  slider.addEventListener('touchstart',e=>{ startX=e.touches[0].clientX; isDragging=true; slides.forEach(img=>img.style.transition='none'); });
  slider.addEventListener('touchmove',e=>{ if(!isDragging) return; currentX=e.touches[0].clientX-startX; updateSlides(currentX/slider.offsetWidth*100); });
  slider.addEventListener('touchend',()=>{ isDragging=false; slides.forEach(img=>img.style.transition='transform 0.3s ease'); if(currentX<-slider.offsetWidth*0.25&&currentIndex<totalSlides-1) currentIndex++; else if(currentX>slider.offsetWidth*0.25&&currentIndex>0) currentIndex--; updateSlides(); currentX=0; });

  slider.addEventListener('mousedown',e=>{ startX=e.clientX; isDragging=true; slides.forEach(img=>img.style.transition='none'); });
  window.addEventListener('mousemove',e=>{ if(!isDragging) return; currentX=e.clientX-startX; updateSlides(currentX/slider.offsetWidth*100); });
  window.addEventListener('mouseup',()=>{ if(!isDragging) return; isDragging=false; slides.forEach(img=>img.style.transition='transform 0.3s ease'); if(currentX<-slider.offsetWidth*0.25&&currentIndex<totalSlides-1) currentIndex++; else if(currentX>slider.offsetWidth*0.25&&currentIndex>0) currentIndex--; updateSlides(); currentX=0; });
});
</script>

</body>
</html>
