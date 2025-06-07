window.addEventListener("DOMContentLoaded", () => {
  const placeholders = [
    "Alvin Wijaya",
    "Jl. Sehat Selalu No.123",
    "081234567890",
    "alvin@example.com",
    "Laki-laki"
  ];

  document.querySelectorAll(".bio-box").forEach((input, index) => {
    input.placeholder = placeholders[index];
  });
});

document.querySelector('.edit-btn').addEventListener('click', () => {
  document.getElementById('modal').style.display = 'flex';
});

const bioInputs = document.querySelectorAll('.bio-box');
document.getElementById('biodataForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const nama = document.getElementById('nama').value;
  const alamat = document.getElementById('alamat').value;
  const telepon = document.getElementById('telepon').value;
  const email = document.getElementById('email').value;
  const gender = document.getElementById('gender').value;

  bioInputs[0].value = nama;
  bioInputs[1].value = alamat;
  bioInputs[2].value = telepon;
  bioInputs[3].value = email;
  bioInputs[4].value = gender;

  document.getElementById('modal').style.display = 'none';
  this.reset();
});

document.querySelectorAll('.sidebar .button')[1].addEventListener('click', () => {
  document.getElementById('logoutModal').style.display = 'flex';
});

document.getElementById('cancelLogout').addEventListener('click', () => {
  document.getElementById('logoutModal').style.display = 'none';
});

document.getElementById('confirmLogout').addEventListener('click', () => {
  window.location.href = 'login.html'; 
});
