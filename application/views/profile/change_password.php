<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Cambiar Contraseña
                </h4>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <!-- <?= $this->session->userdata('message'); ?> -->
                <?= form_open(); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="old_password">Contraseña Actual</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('old_password'); ?>" name="old_password" id="old_password" type="password" class="form-control" placeholder="Contraseña Actual">
                        <?= form_error('old_password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <hr>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="new_password">Nueva Contraseña</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('new_password'); ?>" name="new_password" id="new_password" type="password" class="form-control" placeholder="Nueva Contraseña">
                        <?= form_error('new_password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="confirm_password">Confirmar Contraseña</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('confirm_password'); ?>" name="confirm_password" id="confirm_password" type="password" class="form-control" placeholder="Confirmar Contraseña">
                        <?= form_error('confirm_password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>