$("#form_pembayaran").on("submit", function (e) {
  e.preventDefault();

  var html = "";
  $.ajax({
    url: "admin/ajax/payment.php?action=pembayaran",
    type: "POST",
    data: $(this).serialize(),
    success: function (response) {
      console.log(response);
      var data = JSON.parse(response);
      if (data.status == "success") {
        html += `<form action="admin/ajax/payment.php?action=konfirmasi" method="POST">`;
        html += `<h5>Nama: ${data.user.name}</h5>`;
        html += `<h5>Email: ${data.user.email}</h5>`;
        html += `<h5>Phone: ${data.user.phone}</h5>`;
        html += `<h5>Nama Kamar: ${data.room.name}</h5>`;
        html +=
          '<h5>Nomor Kamar: <span class="text-primary">' +
          data.room.id +
          "</span></h5>";
        html +=
          '<h5>Metode Pembayaran: <span class="text-primary">' +
          data.payment.toUpperCase() +
          "</span></h5>";
        html += `<h5>Total Pembayaran:<span class="text-danger"> Rp. ${data.total_price}</span> </h5>`;
        html += `<h5>Check In: <span class="text-primary">${data.check_in}</span></h5>`;
        html += `<h5>Check Out: <span class="text-primary">${data.check_out}</span></h5>`;
        html += `<button type="submit" class="btn btn-primary">Konfirmasi</button>`;
        // hidden input
        html += `<input type="hidden" name    ="user_id" value="${data.user.id}">`;
        html += `<input type="hidden" name    ="room_id" value="${data.room.id}">`;
        html += `<input type="hidden" name    ="payment" value="${data.payment}">`;
        html += `<input type="hidden" name    ="total_price" value="${data.total_price}">`;
        html += `<input type="hidden" name    ="check_in" value="${data.check_in}">`;
        html += `<input type="hidden" name    ="check_out" value="${data.check_out}">`;
        html += `</form>`;
      } else {
        html += `<h3>${data.message}</hh3`;
      }
      $("#formModalPaymey").html(html);
    },
  });
});
