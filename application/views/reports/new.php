<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Reporte de Transacciones
                </h4>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <!-- <?= $this->session->userdata('message'); ?> -->
                <?= form_open(); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="transaction">Reporte de Transacciones</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-radio">
                            <input value="incoming_goods" type="radio" id="incoming_goods" name="transaction" class="custom-control-input">
                            <label class="custom-control-label" for="incoming_goods">Productos Entrantes</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input value="outgoing_goods" type="radio" id="outgoing_goods" name="transaction" class="custom-control-input">
                            <label class="custom-control-label" for="outgoing_goods">Productos Salientes</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input value="outgoing_goods_total" type="radio" id="outgoing_goods_total" name="transaction" class="custom-control-input">
                            <label class="custom-control-label" for="outgoing_goods_total">Productos Salientes + Total</label>
                        </div>
                        <?= form_error('transaction', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-lg-3 text-lg-right" for="date">Período</label>
                    <div class="col-lg-5">
                        <div class="input-group">
                            <input value="<?= set_value('date'); ?>" name="date" id="date" type="text" class="form-control" placeholder="Período">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
                            </div>
                        </div>
                        <?= form_error('date', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-9 offset-lg-3">
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-print"></i>
                            </span>
                            <span class="text">
                                Crear y Descargar
                            </span>
                        </button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>