<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title; ?> | POS</title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url(); ?>assets/css/fonts.min.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Datepicker -->
  <link href="<?= base_url(); ?>assets/vendor/daterangepicker/daterangepicker.css" rel="stylesheet">

  <!-- DataTables -->
  <link href="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/datatables/buttons/css/buttons.bootstrap4.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/datatables/responsive/css/responsive.bootstrap4.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/gijgo/css/gijgo.min.css" rel="stylesheet">
</head>

<body class="text-sm">
  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <?php
      $b = $data->row_array();
      ?>
      <!-- title row -->
      <div class="row">
        <div class="col-10">
          <h2 class="page-header">
            <i class="fas fa-car"></i> Letter
            <small class="float-right"><b>Invoice #<?php echo $b['id_outgoing_goods']; ?></b></small>
          </h2>
        </div>
        <!-- /.col -->
      </div><br />
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <table align="left" style="border:none;">
            <tr>
              <th>Number </th>
              <th>: <?php echo $b['id_outgoing_goods']; ?></th>
            </tr>
            <tr>
              <th>Out-Date </th>
              <th>: <?php echo date('d F Y', strtotime($b['departure_date'])); ?></th>
            </tr>
            <tr>
              <th>Dear </th>
              <th>: <?php echo $b['recipient_name']; ?></th>
            </tr>
            <tr>
              <th>Sent To </th>
              <th>: <?php echo $b['recipient_name']; ?></th>
            </tr>
            <tr>
              <th></th>
              <th>&nbsp;&nbsp;<?php echo $b['address']; ?></th>
            </tr>
          </table>
        </div>
      </div><br /><br />
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-11 table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th width="250px">Goods Name</th>
                <th width="150px">Type of Good</th>
                <th width="150px">Unit</th>
                <th width="150px">Total Out-Goings</th>
                <!--<th>Total</th>-->
              </tr>
            </thead>
            <tbody>
              <?php

              foreach ($data->result_array() as $i) {
                $item = $i['name_item'];
                $category = $i['category_name'];
                $unit = $i['unit_name'];
                $exit = $i['quantity_out'] . ' ' . $i['unit_name'];
                $total = $i['total_detail_amount'];
              ?>
                <tr>
                  <td style="text-align:left;"><?php echo $item; ?></td>
                  <td style="text-align:left;"><?php echo $category; ?></td>
                  <td style="text-align:left;"><?php echo $unit; ?></td>
                  <td style="text-align:left;"><?php echo $exit; ?></td>
                  <!--<td style="text-align:left;"><?php echo '$' . number_format($total); ?></td>-->
                </tr>
              <?php } ?>
            </tbody>
            <!-- <thead>
            <tr>
                <th colspan="4">Grand Total</th>
                <th><?php echo '$' . number_format($b['total_nominal']); ?></th>
            </tr>
          </thead>
          <?php if ($b['diskon'] > 0) : ?>
          <thead>
            <tr>
                <th colspan="4">Grand Total Setelah Diskon</th>
                <th><?php echo '$' . number_format($b['grand_total']); ?> (<?php echo $b['diskon'] ?>% Discount)</th>
            </tr>
          </thead>-->
          <?php endif ?>
          </table><br /><br />
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <!-- <div class="col-6">
        <br/>
        ** Barang yang diterima sudah dilekatkan Pita Cukai.<br/>
        ** Dilarang menyimpan barang tanpa dilekatkan Pita Cukai.<br/>
        ** Pembayaran dengan cek giro dianggap sah setelah cair.<br/>
        ** SURAT JALAN DAN FAKTUR ASLI ADALAH BUKTI PENAGIHAN/PEMBAYARAN SAH.<br/>
        ** PENAGIHAN TANPA SURAT JALAN ASLI (ada tanda tangan toko) DAN FAKTUR ASLI TOKO TIDAK BOLEH BAYAR<br/>
      </div> -->
        <!-- /.col -->
        <br /><br /><br /><br />
        <div class="col-6">

          <div class="table-responsive">
            <table border='0' align="center">
              <tr></br></br></br>
                <td align="center" style="width:300px">Receiver</td>
                <td align="center" style="width:300px">Driver</td>
                <td align="center" style="width:300px">SF</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td><br /><br /><br /><br /></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td align="center">(.........................................)</td>
                <td align="center">(.........................................)</td>
                <td align="center">(.........................................)</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->
  <!-- Page specific script -->
  <style type="text/css">
    @media print {
      @page {
        size: auto;
        /* auto is the initial value */
        size: A4 portrait;
        margin: 1;
        /* this affects the margin in the printer settings */
        border: 1px solid red;
        /* set a border for all printed pages */
      }
    }
  </style>
  <script>
    window.addEventListener("load", window.print());
  </script>
</body>

</html>