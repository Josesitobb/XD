<?= $this->session->flashdata('message'); ?>
<!-- <?= $this->session->userdata('message'); ?> -->
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Historial de Productos Salientes
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('outgoing_goods/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Agregar Productos Salientes
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover w-100 dt-responsive nowrap" id="dataTable" data-page-length="25">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Fecha</th>
                    <!-- <th>Nama Barang</th> -->
                    <th>Nombre del Destinatario</th>
                    <th>Dirección</th>
                    <!-- <th>Jumlah Keluar</th> -->
                    <!--<th>User</th>-->
                    <th>Descuento</th>
                    <th>Subtotal</th>
                    <th>Total</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($outgoing_goods) :
                    foreach ($outgoing_goods as $bk) :
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $bk['id_outgoing_goods']; ?></td>
                            <td><?= $bk['departure_date']; ?></td>
                            <!-- <td><?= $bk['name_item']; ?></td> -->
                            <td><?= $bk['recipient_name']; ?></td>
                            <td><?= $bk['address']; ?></td>
                            <!-- <td><?= $bk['quantity_out'] . ' ' . $bk['unit_name']; ?></td> -->
                            <!--<td><?= $bk['name']; ?></td>-->
                            <td><?= '$' . number_format($bk['discount']); ?></td>
                            <td><?= '$' . number_format($bk['total_amount']); ?></td>
                            <td><?= '$' . number_format($bk['grand_total']); ?></td>
                            <td>
                                <!-- <a data-toggle="modal" data-target="#invoiceModal" href="#" class="btn btn-circle btn-primary btn-sm"><i class="fa fa-file-invoice" title="Print invoice"></i></a> -->

                                <button type="button" class="btn btn-circle btn-primary btn-sm" onclick="printModal('<?= $bk['id_outgoing_goods']; ?>', 'la factura', 'outgoing_goods/invoice_bill/')">
                                    <i class="fa fa-file-invoice" target="_blank"></i>
                                </button>
                                <button type="button" class="btn btn-circle btn-danger btn-sm" onclick="deleteModal('<?= $bk['id_outgoing_goods']; ?>', 'el producto saliente', 'outgoing_goods/delete/')">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <!-- Print Letter Modal-->
                                <!-- <div class="modal fade" id="letterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro de que quieres imprimir la carta?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">x</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Haz clic en "Confirmar" para imprimir la carta</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                                <a class="btn btn-success" href="<?= base_url('outgoing_goods/invoice_delivery_note/') . $bk['id_outgoing_goods'] ?>"">Confirmar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="9" class="text-center">
                            Sin productos salientes
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Print Invoice Modal-->
<!-- <div class=" modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro de que quieres imprimir la factura?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                            </div>
                            <div class="modal-body">Haz clic en "Confirmar" para imprimir la factura</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                <a class="btn btn-success" href="<?= base_url('outgoing_goods/invoice_bill/') . $bk['id_outgoing_goods'] ?>" target="_blank">Confirmar</a>
                            </div>
                        </div>
                    </div>
            </div> -->