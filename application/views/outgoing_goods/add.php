<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Agregar Productos Salientes
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('outgoing_goods') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <form action="<?php echo base_url('outgoing_goods/add_to_cart'); ?>" method="post">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="row form-group">
                        <label class="col-md-4 text-md-right" for="id_item">Productos</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <select name="id_item" id="id_item" class="custom-select">
                                    <option value="" selected disabled>Seleccionar...</option>
                                    <?php foreach ($items as $b) : ?>
                                        <option value="<?= $b['id_item'] ?>"><?= $b['id_item'] . ' | ' . $b['name_item'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('products/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div> -->
                            </div>
                            <?= form_error('id_item', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-4 text-md-right" for="price">Precio</label>
                        <div class="col-md-5">
                            <input readonly="readonly" id="price" name="price" type="number" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-4 text-md-right" for="stock">Existencias</label>
                        <div class="col-md-5">
                            <input readonly="readonly" id="stock" name="stock" type="number" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-4 text-md-right" for="quantity_out">Cantidad</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input value="<?= set_value('quantity_out'); ?>" name="quantity_out" id="quantity_out" type="number" min="0" value="0" step="1" class="form-control" placeholder="ej: 10">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="unit">Unidades de Medida</span>
                                </div>
                            </div>
                            <?= form_error('quantity_out', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-4 text-md-right" for="total_stock">Existencias Totales</label>
                        <div class="col-md-5">
                            <input readonly="readonly" id="total_stock" type="number" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-4 text-md-right" for="total_nominal">Total</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input readonly="readonly" name="total_nominal" id="total_nominal" type="number" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col offset-md-4">
                            <button type="submit" class="btn btn-primary btn-sm btn-icon-split">
                                <span class="icon">
                                    <i class="fa fa-arrow-down"></i>
                                </span>
                                <span class="text">
                                    Proceder
                                </span>
                            </button>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered" style="font-size:12px;margin-top:10px;">
                        <thead>
                            <tr>
                                <th style="text-align:center;">Productos</th>
                                <th style="text-align:center;">Precio</th>
                                <th style="text-align:center;">Cantidad</th>
                                <th style="text-align:center;">Subtotal</th>
                                <th style="width:100px;text-align:center;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($this->cart->contents() as $items) : ?>
                                <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
                                <tr>
                                    <td style="text-align:center;"><?= $items['id']; ?> | <?= $items['name']; ?></td>
                                    <td style="text-align:center;"><?php echo '$' . number_format($items['amount']); ?></td>
                                    <td style="text-align:center;"><?php echo number_format($items['qty'], 1); ?></td>
                                    <td style="text-align:center;"><?php echo '$' . number_format($items['subtotal']); ?></td>

                                    <td style="text-align:center;"><a href="<?php echo base_url() . 'outgoing_goods/remove/' . $items['rowid']; ?>" class="btn btn-danger btn-sm"> Quitar</a></td>
                                </tr>

                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
            </div>

            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Finalizar
                        </h4>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- <?= form_open('', [], ['id_outgoing_goods' => $id_outgoing_goods, 'id_user' => $this->session->userdata('login_session')['user']]); ?> -->
                <form action="<?php echo base_url('outgoing_goods/add'); ?>" method="post">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input type="hidden" name="id_outgoing_goods" value="<?php echo $id_outgoing_goods; ?>">
                    <input type="hidden" name="id_user" value="<?php echo $this->session->userdata('login_session')['user']; ?>">
                    <div class="row form-group">
                        <label class="col-md-4 text-md-right" for="id_outgoing_goods">ID</label>
                        <div class="col-md-4">
                            <input value="<?= $id_outgoing_goods; ?>" type="text" readonly="readonly" class="form-control">
                            <?= form_error('id_outgoing_goods', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-4 text-md-right" for="departure_date">Fecha de Salida</label>
                        <div class="col-md-4">
                            <input value="<?= set_value('departure_date', date('Y-m-d')); ?>" name="departure_date" id="departure_date" type="text" class="form-control date" placeholder="Fecha de Salida">
                            <?= form_error('departure_date', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-4 text-md-right" for="recipient_name">Nombre del Destinatario</label>
                        <div class="col-md-5">
                            <input id="recipient_name" name="recipient_name" type="text" class="form-control">
                            <?= form_error('recipient_name', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-4 text-md-right" for="address">Dirección</label>
                        <div class="col-md-5">
                            <input id="address" name="address" type="text" class="form-control">
                            <?= form_error('address', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-4 text-md-right" for="discount">Descuento</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input name="discount" id="discount" type="number" class="form-control" min="1" max="999999999" maxlength="9" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                <?= form_error('discount', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-4 text-md-right" for="total_nominal">Total</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input readonly="readonly" name="total_nominal" id="total_nominal_cart" value="<?php echo $this->cart->total(); ?>" type="number" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-4 text-md-right" for="grand_total">Total General</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input readonly="readonly" name="grand_total" id="grand_total" placeholder="<?php echo $this->cart->total(); ?>" type="number" class="form-control">
                                <input name="grand_total_hidden" value="<?php echo $this->cart->total(); ?>" type="hidden" class="form-control">
                            </div>
                        </div>

                    </div>


                    <div class="row form-group">
                        <div class="col offset-md-4">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <button type="reset" class="btn btn-danger">Restablecer</button>
                        </div>
                    </div>
                </form>
                <!-- <?= form_close(); ?> -->
            </div>

        </div>
    </div>
</div>

<!-- Menghilangkan panah di form type number -->
<style type="text/css">
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>