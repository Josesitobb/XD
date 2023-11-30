<!-- Fila Exterior -->
<div class="row justify-content-center align-items-center mt-5 pt-lg-5">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg">
            <div class="card-body p-lg-5 p-0">
                <!-- Fila Anidada dentro del Cuerpo de la Tarjeta -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <h1 class="h4 text-gray-900">VEICO TOOLS</h1>
                                <span class="text-muted">Iniciar sesión</span>
                            </div>
                            <?= $this->session->flashdata('message'); ?>
                            <!-- <?= $this->session->userdata('message'); ?> -->
                            <?= form_open('', ['class' => 'user']); ?>
                            <div class="form-group">
                                <input autofocus="autofocus" autocomplete="off" value="<?= set_value('username'); ?>" type="text" name="username" class="form-control form-control-user" placeholder="Nombre de Usuario">
                                <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-user" placeholder="Contraseña">
                                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Iniciar Sesión
                            </button>
                            <div class="text-center mt-4">
                                <a class="small" href="<?= base_url('register') ?>">Crear una Cuenta</a>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
