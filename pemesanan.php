<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Pemesanan </title>
    <?php require('./admin/inc/links.php'); ?>
</head>

<body>
    <?php require('./inc/header.php'); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4  mx-auto">
                <div class="card">
                    <div class="card-body text-center">
                        <?php
                        if (isset($_SESSION['data'])) {
                            if ($user['picture'] != null || $user['picture'] != '') {
                                echo "<img src='assets/images/user/$user[picture]' class='card-img-top' alt='...'>";
                            } else {
                                echo "<img src='assets/images/user/default.jpg' class='card-img-top' alt='...'>";
                            }
                            echo "<h5 class='card-title'>$user[name]</h5>";
                            echo "<p class='card-text'>$user[email]</p>";
                            echo "<p class='card-text'>$user[phone]</p>";
                            echo "<p class='card-text'>$user[address]</p>";
                        } else {
                            echo "<h5 class='text-center'>Silahkan login terlebih dahulu</h5>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION['data'])) {
                            echo "<h5 class='card-title'>Pemesanan</h5>";
                            $sql = "SELECT * FROM booking WHERE userId = ?";
                            $res = select($sql, [$user['id']], 'i');
                            $booking = [];
                            while ($row = mysqli_fetch_assoc($res)) {
                                $booking[] = $row;
                            }
                            if (count($booking) != 0) {
                                foreach ($booking as $key => $value) {
                                    if ($value['roomId'] == null) {
                                        // fetch bundling
                                        $sql = "SELECT * FROM bundling WHERE id = ?";
                                        $res = select($sql, [$value['bundlingId']], 'i');

                                        // append bundling
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $room[] = $row;
                                        }

                                    } else {
                                        // fetch room
                                        $sql = "SELECT * FROM room WHERE id = ?";
                                        $res = select($sql, [$value['roomId']], 'i');

                                        // append room
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $room[] = $row;
                                        }

                                    }
                                }
                            }
                            $html = "<table class='table table-striped'>";
                            $html .= "<thead>";
                            $html .= "<tr>";
                            $html .= "<th style='width: 10px;'>No Pemesanan</th>";
                            $html .= "<th scope='col'>Room</th>";
                            $html .= "<th scope='col'>Check In</th>";
                            $html .= "<th scope='col'>Check Out</th>";
                            $html .= "<th scope='col'>Total Price</th>";
                            $html .= "<th scope='col'>Status</th>";
                            $html .= "<th scope='col'>Pembayaran</th>";
                            $html .= "<th scope='col'>Invoice</th>";
                            $html .= "<th scope='col'>Upload Bukti Pembayaran</th>";
                            $html .= "</tr>";

                            $html .= "</thead>";
                            $html .= "<tbody>";
                            foreach ($booking as $key => $value) {
                                $html .= "<tr>";
                                $html .= " <th scope='row'>$value[id]</th>";
                                $html .= "<td>";
                                foreach ($room as $k => $v) {
                                    if ($v['id'] == $value['roomId']) {
                                        $html .= "$v[name]";
                                        break;
                                    }
                                    if ($v['id'] == $value['bundlingId']) {
                                        $html .= "$v[name]";
                                        break;

                                    }
                                }

                                $html .= "<td>" . date('Y-m-d', strtotime($value['checkIn'])) . "</td>";
                                $html .= "<td>" . date('Y-m-d', strtotime($value['checkOut'])) . "</td>";
                                $html .= "<td>$value[totalPrice]</td>";
                                $html .= "<td>$value[status]</td>";
                                $html .= "<td>";
                                if ($value['paymentMethod'] == 'DP') {
                                    $html .= "<div class='text-center'>";
                                    $html .= "DP : $value[userPayed] <br>";
                                    $html .= "</div>";
                                } else {
                                    $html .= "<span>Lunas</span>";
                                }
                                if ($value['status'] == 'BOOKED' && $value['paymentMethod'] == 'DP') {
                                    $_SESSION['sukses'] = "Segera lakukan pembayaran untuk mengkonfirmasi pemesanan anda";
                                    $html .= "<td><div class='text-center'><div>";
                                    $html .= "Menunggu Sisa Pembayaran :";
                                    $html .= "<span class='text-danger'> ";
                                    $html .= $value['totalPrice'] - $value['userPayed'];
                                    $html .= "</span>";
                                    $html .= "</div></div></td>";
                                } else if ($value['status'] == 'CANCELLED') {
                                    $html .= "<td><div class='text-center'><div>";
                                    $html .= "Pemesanan Dibatalkan";
                                    $html .= "</div></div></td>";
                                } else if ($value['status'] == 'CHECKEDIN') {
                                    $html .= "<td><div class='text-center'><div>";
                                    $html .= "Check In";
                                    $html .= "</div></div></td>";
                                } else if ($value['status'] == 'CHECKEDOUT') {
                                    $html .= "<td><div class='text-center'><div>";
                                    $html .= "Check Out";
                                    $html .= "</div></div></td>";
                                } else {
                                    $html .= "<td><a href='invoice.php?booking_id=$value[id]&user_id=$user[id]&room_id=$value[roomId]&check_in=$value[checkIn]&check_out=$value[checkOut]&bundling_id=$value[bundlingId]&number_of_people=$value[capacity]' class='btn btn-primary'>Invoice</a></td>";
                                }
                                // if ($value['status'] == 'BOOKED' && $value['paymentMethod'] == 'DP') {
                                $html .= "<td><button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#uploadBuktiPembayaran' data-bs-id='$value[id]'>Upload Bukti Pembayaran</button></td>";
                                // }
                                $html .= "</tr>";
                            }
                            $html .= "</tbody>";
                            $html .= "</table>";
                            echo $html;
                        }
                        ?>

                    </div>
                </div>

                <div class="modal fade" id="uploadBuktiPembayaran" tabindex="-1"
                    aria-labelledby="uploadBuktiPembayaranLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="uploadBuktiPembayaranLabel">Upload Bukti Pembayan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="uploadBuktiPembayarnBody">
                                <form method="POST" enctype="multipart/form-data" id="formUploadBukti">
                                    <input type="hidden" name="action" value="uploadBuktiPembayaran">
                                    <input type="hidden" name="booking_id" id="booking_id">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Upload Bukti
                                            Pembayaran</label>
                                        <input type="file" class="form-control" id="recipient-name"
                                            name="bukti_pembayaran">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <div </div>
                    <?php
                    if (isset($_SESSION['data'])) {
                        echo "<h5 class='text-center mt-5'>No Rekening Hotel</h5>";
                        echo "<span class='pl-5'>Transfer ke nomor rekening <strong>di bawah ini</strong></span>";
                        echo "<span class='pl-5'>Dengan mencantumkan <strong>nomor pemesanan</strong></span>";
                        echo "<div class='card m-4 p-4'>";
                        echo "<h4>BCA</h4>";
                        echo "<h5>1234567890</h5>";
                        echo "</div>";
                        echo "<div class='card m-4 p-4'>";
                        echo "<h4>BCA</h4>";
                        echo "<h5>1234567890</h5>";
                        echo "</div>";
                    }
                    ?>

                </div>
            </div>
            <?php require('./admin/inc/scripts.php'); ?>
            <script>
                $('#uploadBuktiPembayaran').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var id = button.data('bs-id') // Extract info from data-bs-* attributes
                    var modal = $(this)
                    modal.find('.modal-body #booking_id').val(id)
                })
                $('#formUploadBukti').submit(function (e) {
                    e.preventDefault();
                    // id 
                    var id = $('#booking_id').val();
                    var formData = new FormData(this);
                    formData.append('booking_id', id);
                    console.log(formData);
                    $.ajax({
                        url: 'admin/ajax/payment.php?action=uploadBuktiPembayaran',
                        type: 'POST',
                        data: formData,
                        success: function (data) {
                            alert(data);
                            console.log(data);
                            location.reload();
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                });
            </script>
</body>
<?php

if (isset($_SESSION['data'])) {
    require('./inc/footer.php');
}

?>

</html>