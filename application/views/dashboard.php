<div class="row">

    <div class="col-xl-3 col-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Productos</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $items; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-boxes fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Proveedores</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $suppliers; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Existencias</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stock; ?></div>
                            </div>
                            <div class="col-auto">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cubes fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Ingresos</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$<?= $earnings; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-2x text-gray-500 fa-dollar-sign"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header bg-primary py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-white">Transacciones Mensuales en <?= date('Y'); ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="myAreaChart" width="669" height="320" class="chartjs-render-monitor" style="display: block; width: 669px; height: 320px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header bg-primary py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-white">Transacciones de Productos</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="myPieChart" width="302" height="245" class="chartjs-render-monitor" style="display: block; width: 302px; height: 245px;"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Entrantes
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-danger"></i> Salientes
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header bg-warning py-3">
                <h6 class="m-0 font-weight-bold text-white text-center">Productos Con Bajo Stock</h6>
            </div>
            <div class="table-responsive">
                <table class="table mb-0 text-center table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Existencias</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($low_stock_products) :
                            foreach ($low_stock_products as $b) :
                        ?>
                                <tr>
                                    <td><?= $b['name_item']; ?></td>
                                    <td><?= $b['stock']; ?></td>
                                    <td>
                                        <a href="<?= base_url('incoming_goods/add/') . $b['id_item'] ?>" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="text-center">
                                    Sin productos
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header bg-success py-3">
                <h6 class="m-0 font-weight-bold text-white text-center">Transacciones Entrantes Recientes</h6>
            </div>
            <div class="table-responsive">
                <table class="table mb-0 table-sm table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($transactions['incoming_goods'])) : ?>
                            <?php foreach ($transactions['incoming_goods'] as $tbm) : ?>
                                <tr>
                                    <td><strong><?= $tbm['arrival_date']; ?></strong></td>
                                    <td><?= $tbm['name_item']; ?></td>
                                    <td><span class="badge badge-success"><?= $tbm['quantity_in']; ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="text-center">
                                    Sin productos
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header bg-danger py-3">
                <h6 class="m-0 font-weight-bold text-white text-center">Transacciones Salientes Recientes</h6>
            </div>
            <div class="table-responsive">
                <table class="table mb-0 table-sm table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($transactions['outgoing_goods'])) : ?>
                            <?php foreach ($transactions['outgoing_goods'] as $tbk) : ?>
                                <tr>
                                    <td><strong><?= $tbk['departure_date']; ?></strong></td>
                                    <td><?= $tbk['name_item']; ?></td>
                                    <td><span class="badge badge-danger"><?= $tbk['quantity_out']; ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="text-center">
                                    Sin productos
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>