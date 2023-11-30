<?= $this->session->flashdata('message'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Tabla de Proveedores
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('suppliers/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Agregar Proveedor
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
                    <th>Nombre</th>
                    <th>Número de Teléfono</th>
                    <th>Dirección</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($suppliers) :
                    $no = 1;
                    foreach ($suppliers as $s) :
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $s['supplier_name']; ?></td>
                            <td><?= $s['phone_number']; ?></td>
                            <td><?= $s['address']; ?></td>
                            <th>
                                <a href="<?= base_url('suppliers/edit/') . $s['id_supplier'] ?>" class="btn btn-circle btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-circle btn-danger btn-sm" onclick="deleteModal('<?= $s['id_supplier']; ?>', 'el proveedor', 'suppliers/delete/')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Sin proveedores
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>