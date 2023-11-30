<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Editar Unidad de Medida
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('units') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open('', [], ['id_unit' => $unit['id_unit']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="unit_name">Nombre de la Unidad de Medida</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('unit_name', $unit['unit_name']); ?>" name="unit_name" id="unit_name" type="text" class="form-control" placeholder="Nombre de la Unidad de Medida">
                        <?= form_error('unit_name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="reset" class="btn btn-danger">Restablecer</bu>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>