<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Agregar Productos Entrantes
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('incoming_goods') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open('', [], ['id_incoming_goods' => $id_incoming_goods, 'id_user' => $this->session->userdata('login_session')['user']]); ?>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="id_incoming_goods">ID</label>
                    <div class="col-md-4">
                        <input value="<?= $id_incoming_goods; ?>" type="text" readonly="readonly" class="form-control">
                        <?= form_error('id_incoming_goods', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="arrival_date">Entry Date</label>
                    <div class="col-md-4">
                        <input value="<?= set_value('arrival_date', date('Y-m-d')); ?>" name="arrival_date" id="arrival_date" type="text" class="form-control date" placeholder="Fecha...">
                        <?= form_error('arrival_date', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="id_supplier">Proveedor</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <select name="id_supplier" id="id_supplier" class="custom-select">
                                <option value="" selected disabled>Seleccionar Proveedor...</option>
                                <?php foreach ($supplier as $s) : ?>
                                    <option <?= set_select('id_supplier', $s['id_supplier']) ?> value="<?= $s['id_supplier'] ?>"><?= $s['supplier_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('supplier/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('id_supplier', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="id_item">Productos</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <select name="id_item" id="id_item" class="custom-select">
                                <option value="" selected disabled>Seleccionar Productos...</option>
                                <?php foreach ($item as $b) : ?>
                                    <option <?= $this->uri->segment(3) == $b['id_item'] ? 'selected' : '';  ?> <?= set_select('id_item', $b['id_item']) ?> value="<?= $b['id_item'] ?>"><?= $b['id_item'] . ' | ' . $b['name_item'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('products/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('id_item', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="stock">Inventario</label>
                    <div class="col-md-5">
                        <input readonly="readonly" id="stock" type="number" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="quantity_in">Cantidad</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input value="<?= set_value('quantity_in'); ?>" name="quantity_in" id="quantity_in" type="number" min="0" value="0" step="1" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text" id="satuan">Unidad</span>
                            </div>
                        </div>
                        <?= form_error('quantity_in', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="total_stock">Inventario Tota</label>
                    <div class="col-md-5">
                        <input readonly="readonly" id="total_stock" type="number" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col offset-md-4">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="reset" class="btn btn-danger">Restablecer</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var selectedProductId = "<?= $this->uri->segment(3); ?>";
        if (selectedProductId) {
            $('#id_item').val(selectedProductId).change();
        }
    });

    var a = document.getElementById("id_item");
    var b = $('#id_item');
</script>

