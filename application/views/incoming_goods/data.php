<?= $this->session->flashdata('message'); ?>
<!-- <?= $this->session->userdata('message'); ?> -->
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Historial de Productos Entrantes
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('incoming_goods/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Agregar Productos Entrantes
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover w-100 dt-responsive nowrap" id="dataTable" data-page-length="25">
            <thead>
                <tr>
                    <th># </th>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Nombre del Producto</th>
                    <th>Cantidad</th>
                    <th>Usuario</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($incoming_goods) :
                    foreach ($incoming_goods as $bm) :
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $bm['id_incoming_goods']; ?></td>
                            <td><?= $bm['arrival_date']; ?></td>
                            <td><?= $bm['supplier_name']; ?></td>
                            <td><?= $bm['name_item']; ?></td>
                            <td><?= number_format($bm['quantity_in'], 1) . ' ' . $bm['unit_name']; ?></td>
                            <td><?= $bm['name']; ?></td>
                            <td>
                                <button type="button" class="btn btn-circle btn-danger btn-sm" onclick="deleteModal('<?= $bm['id_incoming_goods']; ?>', 'el producto entrante', 'incoming_goods/delete/')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">
                            Sin productos entrantes
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>