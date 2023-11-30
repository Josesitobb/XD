<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Editar Perfil de Usuario
                </h4>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <!-- <?= $this->session->userdata('message'); ?> -->
                <?= form_open_multipart('profile/edit', [], ['id_user' => $user['id_user']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="picture">Imagen</label>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-3">
                                <img src="<?= base_url() ?>assets/img/avatar/<?= $user['picture']; ?>" alt="<?= $user['name']; ?>" class="rounded-circle shadow-sm img-thumbnail">
                            </div>
                            <div class="col-9">
                                <input type="file" name="picture" id="picture">
                                <?= form_error('picture', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="username">Nombre de usuario</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-user"></i></span>
                            </div>
                            <input value="<?= set_value('username', $user['username']); ?>" name="username" id="username" type="text" class="form-control" placeholder="Username...">
                        </div>
                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <hr>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama">Nombre completo</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-user"></i></span>
                            </div>
                            <input value="<?= set_value('name', $user['name']); ?>" name="name" id="name" type="text" class="form-control" placeholder="Nombre...">
                        </div>
                        <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="email">Correo electrónico</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-envelope"></i></span>
                            </div>
                            <input value="<?= set_value('email', $user['email']); ?>" name="email" id="email" type="text" class="form-control" placeholder="Email...">
                        </div>
                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="no_telp">Número de Teléfono</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-phone"></i></span>
                            </div>
                            <input value="<?= set_value('phone_number', $user['phone_number']); ?>" name="phone_number" id="phone_number" type="text" class="form-control" placeholder="Número de Teléfono...">
                        </div>
                        <?= form_error('phone_number', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <hr>
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