<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm mb-4 border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Editar Usuario
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('users') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Regresar
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body pb-2">
                <?= $this->session->flashdata('message'); ?>
                <!-- <?= $this->session->userdata('message'); ?> -->
                <?= form_open('', [], ['id_user' => $users['id_user']]); ?>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="username">Nombre de Usuario</label>
                    <div class="col-md-6">
                        <input value="<?= set_value('username', $users['username']); ?>" type="text" id="username" name="username" class="form-control" placeholder="Nombre de Usuario">
                        <?= form_error('username', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <hr>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="nama">Nombre</label>
                    <div class="col-md-6">
                        <input value="<?= set_value('name', $users['name']); ?>" type="text" id="name" name="name" class="form-control" placeholder="Nombre">
                        <?= form_error('name', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="email">Correo Electrónico</label>
                    <div class="col-md-6">
                        <input value="<?= set_value('email', $users['email']); ?>" type="text" id="email" name="email" class="form-control" placeholder="Correo Electrónico">
                        <?= form_error('email', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="phone_number">Número de Teléfono</label>
                    <div class="col-md-6">
                        <input value="<?= set_value('phone_number', $users['phone_number']); ?>" type="text" id="phone_number" name="phone_number" class="form-control" placeholder="Número de Teléfono">
                        <?= form_error('phone_number', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="role">Rol</label>
                    <div class="col-md-6">
                        <div class="custom-control custom-radio">
                            <input <?= $users['role'] == 'admin' ? 'checked' : ''; ?> <?= set_radio('role', 'admin'); ?> value="admin" type="radio" id="admin" name="role" class="custom-control-input">
                            <label class="custom-control-label" for="admin">Administrador</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input <?= $users['role'] == 'employee' ? 'checked' : ''; ?> <?= set_radio('role', 'employee'); ?> value="employee" type="radio" id="employee" name="role" class="custom-control-input">
                            <label class="custom-control-label" for="gudang">Empleado</label>
                        </div>
                        <?= form_error('role', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <br>
                <div class="row form-group justify-content-end">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon"><i class="fa fa-save"></i></span>
                            <span class="text">Guardar</span>
                        </button>
                        <button type="reset" class="btn btn-danger">Restablecer</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>