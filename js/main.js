
// document.addEventListener('DOMContentLoaded', () => {
//     const container = document.getElementById('keranjangContainer');
//     const keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];

//     if (keranjang.length === 0) {
//         container.innerHTML += "<p>Keranjang kamu kosong.</p>";
//         return;
//     }
//      let totalSemua = 0
//     keranjang.forEach((item, index) => {
        
//         const subtotal = item.harga * item.jumlah;
//     totalSemua += subtotal
//         const elemen = document.createElement('div');
//         elemen.className = 'item-keranjang';
//         elemen.innerHTML = `
//             <img class="gambar-produk" src="${item.gambar}" alt="${item.nama}">
//             <div class="info-produk">
//                 <h4 class="nama-item">${item.nama}</h4>
//                 <div class="harga">Rp ${item.harga}</div>
//             </div>
//             <div class="jumlah">
//                 <button onclick="ubahJumlah(${index}, -1)">-</button>
//                 <input class="input-jumlah" type="text" value="${item.jumlah}" disabled>
//                 <button onclick="ubahJumlah(${index}, 1)">+</button>
//             </div>
//             <div class="subtotal">Rp ${subtotal}</div>
//             <button class="hapus" onclick="hapusItem(${index})">Hapus</button>
//             `;
//         container.appendChild(elemen);
        
//     });

// const totalProduk = document.createElement('div');
// totalProduk.className = 'totalProduk';
// totalProduk.innerHTML = `<h3 style = "text-align: right">Rp ${totalSemua.toLocaleString()}</h3>;`

// const pembayaran = document.createElement('button');
// pembayaran.className = "buttonPembayaran"
// pembayaran.innerHTML = `Pembayaran`
//     container.appendChild(totalProduk)
// pembayaran.addEventListener('click')
// container.appendChild(pembayaran)
// });

// function ubahJumlah(index, perubahan) {
//     const keranjang = JSON.parse(localStorage.getItem('keranjang'));
//     keranjang[index].jumlah += perubahan;
//     if (keranjang[index].jumlah <= 0) keranjang.splice(index, 1);
//     localStorage.setItem('keranjang', JSON.stringify(keranjang));
//     location.reload();
// }

// function hapusItem(index) {
//     const keranjang = JSON.parse(localStorage.getItem('keranjang'));
//     keranjang.splice(index, 1);
//     localStorage.setItem('keranjang', JSON.stringify(keranjang));
//     location.reload();
// }

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
  window.location.href = 'index.php'; 
});