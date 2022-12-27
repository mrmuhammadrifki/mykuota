let total = 0;
let kuotaTitle = "";
let koutaSize = "";

let hasilTotal = document.getElementById("total_bayar");
let inputKuotaName = document.querySelector("#kuota_name");
let inputKuotaSize = document.querySelector("#kuota_size");
let inputKuotaPrice = document.querySelector("#kuota_price");

const listkuota = document.querySelectorAll("#kuota-item");

listkuota.forEach((item) => {
  item.addEventListener("click", function () {
    const pilihKouta = this;

    total = pilihKouta.querySelector("#cost");

    kuotaName = pilihKouta.querySelector(".card-header");
    koutaSize = pilihKouta.querySelector(".card-title");

    listkuota.forEach((i) => {
      i.classList.remove("pilih");
    });

    if (pilihKouta.classList.contains("pilih")) {
      pilihKouta.classList.remove("pilih");
    } else {
      hasilTotal.value = 0;
      pilihKouta.classList.add("pilih");
      hasilTotal.value = `Rp ${total.innerText}`;

      inputKuotaName.value = kuotaName.innerText;
      inputKuotaSize.value = koutaSize.innerText;
      inputKuotaPrice.value = total.innerText;
    }
  });
});
