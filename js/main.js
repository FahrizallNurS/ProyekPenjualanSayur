
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('keranjangContainer');
    const keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];

    if (keranjang.length === 0) {
        container.innerHTML += "<p>Keranjang kamu kosong.</p>";
        return;
    }
     let totalSemua = 0
    keranjang.forEach((item, index) => {
        
        const subtotal = item.harga * item.jumlah;
    totalSemua += subtotal
        const elemen = document.createElement('div');
        elemen.className = 'item-keranjang';
        elemen.innerHTML = `
            <img class="gambar-produk" src="${item.gambar}" alt="${item.nama}">
            <div class="info-produk">
                <h4 class="nama-item">${item.nama}</h4>
                <div class="harga">Rp ${item.harga}</div>
            </div>
            <div class="jumlah">
                <button onclick="ubahJumlah(${index}, -1)">-</button>
                <input class="input-jumlah" type="text" value="${item.jumlah}" disabled>
                <button onclick="ubahJumlah(${index}, 1)">+</button>
            </div>
            <div class="subtotal">Rp ${subtotal}</div>
            <button class="hapus" onclick="hapusItem(${index})">Hapus</button>
            `;
        container.appendChild(elemen);
        
    });

const totalProduk = document.createElement('div');
totalProduk.className = 'totalProduk';
totalProduk.innerHTML = `<h3 style = "text-align: right">Rp ${totalSemua.toLocaleString()}</h3>;`

const pembayaran = document.createElement('button');
pembayaran.className = "buttonPembayaran"
pembayaran.innerHTML = `Pembayaran`
    container.appendChild(totalProduk)

container.appendChild(pembayaran)
});

function ubahJumlah(index, perubahan) {
    const keranjang = JSON.parse(localStorage.getItem('keranjang'));
    keranjang[index].jumlah += perubahan;
    if (keranjang[index].jumlah <= 0) keranjang.splice(index, 1);
    localStorage.setItem('keranjang', JSON.stringify(keranjang));
    location.reload();
}

function hapusItem(index) {
    const keranjang = JSON.parse(localStorage.getItem('keranjang'));
    keranjang.splice(index, 1);
    localStorage.setItem('keranjang', JSON.stringify(keranjang));
    location.reload();
}

