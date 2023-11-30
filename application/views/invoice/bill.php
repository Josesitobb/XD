<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Factura | Veico Tools</title>

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

<body style="padding: 3rem">
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
            <i class="fas fa-file-invoice-dollar"></i> <b>Factura #<?php echo $b['id_outgoing_goods']; ?></b>
            <small class="float-right">
              <b><?php echo date('d F Y', strtotime($b['departure_date'])); ?></b></small>
          </h2>
        </div>
        <!-- /.col -->
      </div><br />
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <table align="left" style="border:none;">
            <tr>
              <th>Cliente </th>
              <th>: <?php echo $b['recipient_name']; ?></th>
            </tr>
            <tr>
              <th></th>
              <th>&nbsp;&nbsp;<?php echo $b['address']; ?></th>
            </tr>
          </table>
        </div>
        <!-- /.col -->

      </div><br /><br />
      <!-- Table row -->
      <div class="row">
        <div class="col-11 table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Unidad</th>
                <th>Cantidad</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 0;
              $qtyw = 0;
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
                  <td style="text-align:left;"><?php echo '$' . number_format($total); ?></td>
                </tr>
              <?php } ?>
            </tbody>
            <thead>
              <tr>
                <th colspan="4">Total General</th>
                <th><?php echo '$' . number_format($b['total_amount']); ?></th>
              </tr>
            </thead>
            <?php if ($b['discount'] > 0) : ?>
              <thead>
                <tr>
                  <th colspan="4">Total General (con descuento)</th>
                  <th><?php echo '$' . number_format($b['grand_total']); ?> (<?php echo $b['discount'] ?>% Descuento)</th>
                </tr>
              </thead>
            <?php endif ?>
          </table><br /><br />
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-9">
          <br />
        </div>
        <!-- /.col -->
        <div class="col-3">
          <!-- <p class="lead">Amount Due 2/22/2014</p> -->

          <div class="table-responsive">
            <table border='0' align="center">
              <tr>
                <td align="center">Destinatario</td>
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
                <td align="center">(.............................................)</td>
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
  <script>
    window.addEventListener("load", window.print());
  </script>
</body>

</html>