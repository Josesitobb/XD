<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Agregar Productos
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('products') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open('', [], ['stock' => 0]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="id_item">ID del Producto</label>
                    <div class="col-md-9">
                        <input readonly value="<?= set_value('id_item', $id_item); ?>" name="id_item" id="id_item" type="text" class="form-control" placeholder="ID...">
                        <?= form_error('id_item', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama_barang">Nombre del Producto</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('name_item'); ?>" name="name_item" id="name_item" type="text" class="form-control" placeholder="Nombre del Producto">
                        <?= form_error('name_item', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="jenis_id">Categoría</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="id_category" id="id_category" class="custom-select">
                                <option value="" selected disabled>Seleccionar...</option>
                                <?php foreach ($category as $j) : ?>
                                    <option <?= set_select('id_category', $j['id_category']) ?> value="<?= $j['id_category'] ?>"><?= $j['category_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('categories/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('id_category', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="id_unit">Unidades de Medida</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="id_unit" id="id_unit" class="custom-select">
                                <option value="" selected disabled>Seleccionar...</option>
                                <?php foreach ($unit as $s) : ?>
                                    <option <?= set_select('id_unit', $s['id_unit']) ?> value="<?= $s['id_unit'] ?>"><?= $s['unit_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('units/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('id_unit', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="price">Precio</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">$</span>
                            </div>
                            <input value="<?= set_value('price'); ?>" name="price" id="price" type="number" class="form-control" placeholder="Precio">
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="reset" class="btn btn-danger">Restablecer</bu>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>