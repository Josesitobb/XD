<?= $this->session->flashdata('message'); ?>
<!-- <?= $this->session->userdata('message'); ?> -->
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Tabla de Productos
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('products/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Agregar Productos
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
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Inventario</th>
                    <th>Medida</th>
                    <th>Precio</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($items) :
                    foreach ($items as $b) :
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $b['id_item']; ?></td>
                            <td><?= $b['name_item']; ?></td>
                            <td><?= $b['category_name']; ?></td>
                            <td><?= $b['stock']; ?></td>
                            <td><?= $b['unit_name']; ?></td>
                            <td><?php echo '$' . number_format($b['price']); ?></td>

                            <td>
                                <a href="<?= base_url('products/edit/') . $b['id_item'] ?>" class="btn btn-info btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-circle btn-danger btn-sm" onclick="deleteModal('<?= $b['id_item']; ?>', 'el producto', 'products/delete/')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">
                            Sin productos
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- <script>
    function showDeleteModal(id) {
        const title = 'Confirmación de Eliminación';
        const bodyText = 'Haz clic en "Eliminar" para eliminar el producto';
        const cancelButtonText = 'Cancelar';
        const buttonText = 'Eliminar';
        const buttonClass = 'btn-danger';
        const buttonHref = `products/delete/${id}`; // Replace with the appropriate URL

        ModalManager.createCustomModal(id, title, bodyText, cancelButtonText, buttonText, buttonClass, buttonHref);
        ModalManager.showModal(id);
    }
</script> -->