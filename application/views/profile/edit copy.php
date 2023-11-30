<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <!-- <?= $this->session->userdata('message'); ?> -->
                <?= form_open_multipart('profile/edit', [], ['id_user' => $user['id_user']]); ?>
                <div class="row form-group">
                    <div class="row">
                        <div class="col-3">
                            <img src="<?= base_url() ?>assets/img/avatar/<?= $user['picture']; ?>" alt="<?= $user['name']; ?>" class="rounded-circle shadow-sm img-thumbnail">
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <input value="<?= set_value('username', $user['username']); ?>" name="username" id="username" type="text" class="form-control" placeholder="Username...">
                </div>
                <div class="row form-group">
                    <input value="<?= set_value('name', $user['name']); ?>" name="name" id="name" type="text" class="form-control" placeholder="Nombre...">
                </div>
                <div class="row form-group">
                    <input value="<?= set_value('email', $user['email']); ?>" name="email" id="email" type="text" class="form-control" placeholder="Email...">
                </div>
                <div class="row form-group">
                    <input value="<?= set_value('phone_number', $user['phone_number']); ?>" name="phone_number" id="phone_number" type="text" class="form-control" placeholder="Número de Teléfono...">
                </div>
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="reset" class="btn btn-danger">Restablecer</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>