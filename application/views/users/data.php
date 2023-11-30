<?= $this->session->flashdata('message'); ?>
<!-- <?= $this->session->userdata('message'); ?> -->
<div class="card shadow-sm mb-4 border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Tabla de Usuarios
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('users/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-user-plus"></i>
                    </span>
                    <span class="text">
                        Agregar Usuario
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped dt-responsive table-hover nowrap" id="dataTable" data-page-length="25">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Nombre de Usuario</th>
                    <th>Correo Electrónico</th>
                    <th>Número de Teléfono</th>
                    <th>Rol</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($users) :
                    foreach ($users as $user) :
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $user['name']; ?></td>
                            <td><?= $user['username']; ?></td>
                            <td><?= $user['email']; ?></td>
                            <td><?= $user['phone_number']; ?></td>
                            <td><?php if ($user['role'] == "employee") {
                                    echo "Employee";
                                } else {
                                    echo "Admin";
                                } ?></td>
                            <td>
                                <a href="<?= base_url('users/toggle/') . $user['id_user'] ?>" class="btn btn-circle btn-sm <?= $user['is_active'] ? 'btn-danger' : 'btn-success' ?>" title="<?= $user['is_active'] ? 'Inhabilitar Usuario' : 'Habilitar Usuario' ?>"><i class="fa fa-fw fa-power-off"></i></a>
                                <a href="<?= base_url('users/edit/') . $user['id_user'] ?>" class="btn btn-circle btn-sm btn-info"><i class="fa fa-fw fa-edit"></i></a>
                                <button type="button" class="btn btn-circle btn-danger btn-sm" onclick="deleteModal('<?= $user['id_user']; ?>', 'el usario', 'users/delete/')">
                                    <i class="fa fa-trash"></i>
                                </button>    
                            </td>
                        </tr>
                    <?php endforeach;
                else : ?>
                    <tr>
                        <td colspan="8" class="text-center">Sin usuarios</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>