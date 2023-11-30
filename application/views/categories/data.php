<?= $this->session->flashdata('message'); ?>
<!-- <?= $this->session->userdata('message'); ?> -->
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Tabla de Categorías
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('categories/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Agregar Categoría
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="dataTable" data-page-length="25">
            <thead>
                <tr>
                    <th># </th>
                    <th>Nombre de la Categoría</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($category) :
                    foreach ($category as $j) :
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $j['category_name']; ?></td>
                            <td>
                                <a href="<?= base_url('categories/edit/') . $j['id_category'] ?>" class="btn btn-info btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                <!-- <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('jenis/delete/') . $j['id_category'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a> -->
                                <!-- <a data-toggle="modal" data-target="#deleteModal<?= $j['id_category']; ?>" href="#" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a> -->
                                <button type="button" class="btn btn-circle btn-danger btn-sm" onclick="deleteModal('<?= $j['id_category']; ?>', 'la categoría', 'categories/delete/')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3" class="text-center">
                            Sin categorías
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>