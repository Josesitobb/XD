<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Editar Proveedor
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('suppliers') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <!-- <?= $this->session->userdata('message'); ?> -->
                <?= form_open('', [], ['id_supplier' => $supplier['id_supplier']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="supplier_name">Nombre del Proveedor</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-user"></i></span>
                            </div>
                            <input value="<?= set_value('supplier_name', $supplier['supplier_name']); ?>" name="supplier_name" id="supplier_name" type="text" class="form-control" placeholder="Nombre del Proveedor">
                        </div>
                        <?= form_error('supplier_name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="no_telp">Número de Contacto</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-phone"></i></span>
                            </div>
                            <input value="<?= set_value('phone_number', $supplier['phone_number']); ?>" name="phone_number" id="phone_number" type="text" class="form-control" placeholder="Número de Contacto">
                        </div>
                        <?= form_error('phone_number', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="address">Dirección del Proveedor</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                            </div>
                            <textarea name="address" id="address" class="form-control" rows="4" placeholder="Dirección del Proveedor"><?= set_value('address', $supplier['address']); ?></textarea>
                        </div>
                        <?= form_error('address', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="reset" class="btn btn-danger">Restablecer</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>