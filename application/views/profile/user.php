<div class="card p-2 shadow-sm border-bottom-primary">
    <div class="card-header bg-white">
        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
            Perfil de <?= userdata('name');?>
        </h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2 mb-4 mb-md-0">
                <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">
                <img src="<?= base_url() ?>assets/img/avatar/<?= userdata('picture'); ?>" alt="" class="img-thumbnail rounded mb-2">
                <a href="<?= base_url('profile/edit'); ?>" class="btn btn-sm btn-block btn-primary"><i class="fa fa-edit"></i> Editar Perfil</a>
                <a href="<?= base_url('profile/change_password'); ?>" class="btn btn-sm btn-block btn-primary"><i class="fa fa-lock"></i> Cambiar Contraseña</a>
            </div>
            <div class="col-md-10">
                <table class="table">
                    <tr>
                        <th width="200">Nombre de usuario</th>
                        <td><?= userdata('username'); ?></td>
                    </tr>
                    <tr>
                        <th width="200">Nombre completo</th>
                        <td><?= userdata('name'); ?></td>
                    </tr>
                    <tr>
                        <th>Correo electrónico</th>
                        <td><?= userdata('email'); ?></td>
                    </tr>
                    <tr>
                        <th>Número de teléfono</th>
                        <td><?= userdata('phone_number'); ?></td>
                    </tr>
                    <tr>
                        <th>Rol</th>
                        <td class="text-capitalize"><?php if(userdata('role') =='employee') { echo "Employee";} else {echo"Admin";} ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>