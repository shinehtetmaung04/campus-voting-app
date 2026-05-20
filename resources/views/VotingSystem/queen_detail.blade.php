<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Queen Selection Details Page</title>

  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/king_selection.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/king_detail.css') }}" />
</head>
<body>
<header class="top-bar">
  <div class="menu-icon">
    <img src="../Images/logo.png" alt="Logo">
    <div class="logo-container">
      <div class="logo">University of Computer Studies (Thaton)</div>
    </div>
  </div>
  <nav class="sub-nav-links" id="navLinks">
    <a href="{{ asset('home') }}">Home</a>
    <span>•</span>
    <a href="{{ asset('king_selection') }}">King</a>
    <span>•</span>
    <a href="{{ asset('queen_selection') }}" class="active">Queen</a>
  </nav>
</header>

@php
$loginCode = session('login_code');
$currentUser = \App\Models\User::where('login_code', $loginCode)->first();
@endphp

<section class="ranking-section">
  <div class="ranking-container">
    <div class="contest-card second">
      <div class="slider">
        <a href="#"><img src="{{ asset($clickedImage->image_url) }}" alt="{{ $queen->name }}"></a>
        <div class="slider-dots"></div>
      </div>

      <div class="card-body" style="height: auto;">
        <button class="back-arrow-modern" onclick="history.back();">&#8592;</button>

        <div class="name-pair">
          <div class="left-name" style="white-space:normal; overflow:visible; text-align:left;">{{ $queen->name }}</div>
          <div class="rank-badge">{{ $queen->number }}</div>
        </div>

        <table>
          <tr>
            <td class="pfLeft">Birthday</td>
            <td>:</td>
            <td class="pfRight">{{ \Carbon\Carbon::parse($queen->birthday)->format('F d Y') }}</td>
          </tr>
          <tr>
            <td class="pfLeft">Zodiac</td>
            <td>:</td>
            <td class="pfRight">{{ $queen->zodiac }}</td>
          </tr>
          <tr>
            <td class="pfLeft">Hobby</td>
            <td>:</td>
            <td class="pfRight">{{ $queen->hobby }}</td>
          </tr>
          <tr>
            <td class="pfLeft">Height</td>
            <td>:</td>
            <td class="pfRight">{{ $queen->height }}</td>
          </tr>
          <tr>
            <td class="pfLeft">Hometown</td>
            <td>:</td>
            <td class="pfRight">{{ $queen->hometown }}</td>
          </tr>
        </table>

        <div class="votebutton">
          <form method="POST" action="{{ route('vote.queen', ['id' => $queen->sel_id]) }}">
            @csrf
            <button type="button"
              class="vote1 vote-btn"
              data-name="{{ $queen->name }}"
              data-logged-in="{{ $loginCode ? '1' : '0' }}"
              @if($currentUser && $currentUser->qflag == 0) disabled @endif
            >Vote</button>
          </form>
        </div>
      </div>
    </div>
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

<!-- SUCCESS MODAL -->
<div id="doneVotingModal" class="modal">
  <div class="modal-content done-voting-modal-content">
    <h3>Success 🎉</h3>
    <p id="doneVotingText"></p>
  </div>
</div>

<script>
let selectedForm = null;
let pendingVoteName = '';

// ================= VOTE BUTTON =================
document.querySelectorAll('.vote-btn').forEach(btn => {
  btn.onclick = function() {
    if(this.disabled) return;
    selectedForm = this.closest('form');
    pendingVoteName = this.dataset.name;

    if(this.dataset.loggedIn === "1") {
      showConfirm(pendingVoteName);
    } else {
      document.getElementById('loginModal').style.display = 'flex';
    }
  }
});

// ================= SHOW CONFIRM MODAL =================
function showConfirm(name) {
  document.getElementById('voteConfirmText').innerText = `Vote to (${name})?`;
  document.getElementById('voteConfirmModal').style.display = 'flex';
}

// ================= CONFIRM VOTE =================
document.getElementById('confirmVote').onclick = () => {
  document.getElementById('voteConfirmModal').style.display = 'none';
  showLoading();
  selectedForm.submit();
};
document.getElementById('cancelVote').onclick = () => {
  document.getElementById('voteConfirmModal').style.display = 'none';
};

// ================= LOGIN + CONFIRM AFTER LOGIN =================
const loginSubmit = document.getElementById('loginSubmit');
const loginCodeInput = document.getElementById('loginCode');
const errorLogin = document.getElementById('errorLogin');
const loginModal = document.getElementById('loginModal');
const loadingModal = document.getElementById('loadingModal');
const loaderContent = document.getElementById('loaderContent');
const closeLogin = document.getElementById('closeLogin');

loginSubmit.onclick = function() {
  const code = loginCodeInput.value.trim();
  if(!code) {
    errorLogin.innerText = "Please enter your login code";
    errorLogin.style.display = "block";
    return;
  }

  errorLogin.style.display = "none";
  loginModal.style.display = "none";
  showLoading();

  const formData = new FormData();
  formData.append('login_code', code);

  fetch("{{ url('/login') }}", {
    method: "POST",
    headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    hideLoading();
    if(data.status === 'success') {
      showConfirm(pendingVoteName);
    } else {
      errorLogin.innerText = data.message || "Login Failed";
      errorLogin.style.display = "block";
      loginModal.style.display = 'flex';
    }
  })
  .catch(() => {
    hideLoading();
    errorLogin.innerText = "Login Failed";
    errorLogin.style.display = "block";
    loginModal.style.display = 'flex';
  });
};

closeLogin.onclick = () => loginModal.style.display = 'none';

// ================= LOADING FUNCTIONS =================
function showLoading() {
  loaderContent.className = 'loading-animation';
  loaderContent.innerHTML = '<div></div><div></div><div></div><div></div><div></div>';
  loadingModal.style.display = 'flex';
}
function hideLoading() {
  loadingModal.style.display = 'none';
}

// ================= SHOW SUCCESS AFTER REDIRECT =================
@if(session('vote_success'))
window.onload = function() {
  document.getElementById('doneVotingText').innerText = 'Voted to {{ session("vote_success") }}';
  document.getElementById('doneVotingModal').style.display = 'flex';
  setTimeout(() => {
    document.getElementById('doneVotingModal').style.display = 'none';
    window.location.reload();
  }, 2000);
};
@endif
</script>

</body>
</html>
