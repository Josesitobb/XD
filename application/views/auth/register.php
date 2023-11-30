<!-- Outer Row -->
<div class="row justify-content-center mt-5">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg">
            <div class="card-body p-lg-5 p-0">
                <div class="p-4">
                    <div class="text-center mb-4">
                        <h1 class="h4 text-gray-900">VEICO TOOLS</h1>
                        <span class="text-muted">Crear una Cuanta</span>
                    </div>
                    <?= $this->session->flashdata('message'); ?>
                    <!-- <?= $this->session->userdata('message'); ?> -->
                    <?= form_open('', ['class' => 'user']); ?>
                    <div class="form-group">
                        <input autofocus="autofocus" autocomplete="off" value="<?= set_value('username'); ?>" type="text" name="username" class="form-control form-control-user" placeholder="Nombre de Usuario">
                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-user" placeholder="Contraseña">
                                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="password" name="password2" class="form-control form-control-user" placeholder="Confirmar Contraseña">
                                <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input value="<?= set_value('name'); ?>" type="text" name="name" class="form-control form-control-user" placeholder="Nombre">
                        <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input value="<?= set_value('email'); ?>" type="text" name="email" class="form-control form-control-user" placeholder="Correo Electrónico">
                                <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input value="<?= set_value('phone_number'); ?>" type="text" name="phone_number" class="form-control form-control-user" placeholder="Número de Teléfono">
                                <?= form_error('phone_number', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Crear mi Cuanta
                    </button>
                    <div class="text-center mt-4">
                        <a class="small" href="<?= base_url('auth') ?>">Ya Tengo una Cuenta → Iniciar Sesión</a>
                    </div>
                    <?= form_close(); ?>

                </div>
            </div>
        </div>

    </div>
</div>