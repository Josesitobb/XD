<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?> | Veico Tools</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/css/fonts.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Datepicker -->
    <link href="<?= base_url(); ?>assets/vendor/daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- DataTables -->
    <link href="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendor/datatables/buttons/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendor/datatables/responsive/css/responsive.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendor/gijgo/css/gijgo.min.css" rel="stylesheet">

    <style>
        #accordionSidebar,
        .topbar {
            z-index: 1;
        }
    </style>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <!-- <script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script> -->
    <!-- <script src="<?= base_url(); ?>assets/js/sb-admin-2.js"></script> -->
    <script src="<?= base_url(); ?>assets/js/functions.js"></script>

    <!-- Datepicker -->
    <script src="<?= base_url(); ?>assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/daterangepicker/daterangepicker.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/jszip/jszip.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.colVis.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/responsive/js/responsive.bootstrap4.min.js"></script>

    <script src="<?= base_url(); ?>assets/vendor/gijgo/js/gijgo.min.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-white sidebar sidebar-light accordion shadow-sm" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex text-white align-items-center bg-primary justify-content-center" href="<?= base_url(); ?>">
                <div class="sidebar-brand-icon">
                    <!-- <i class="fas fa-cash-register"></i> -->
                    <i class="fas fa-cash-register"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Veico Tools</div>
            </a>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item pt-2">
                <a class="nav-link" href="<?= base_url('dashboard'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tablero de Control</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Administrar
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('suppliers'); ?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Proveedores</span>
                </a>
            </li>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('products'); ?>">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Productos</span>
                </a>
            </li>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('categories'); ?>">
                    <i class="fas fa-fw fa-tag"></i>
                    <span>Categorías</span>
                </a>
            </li>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('units'); ?>">
                    <i class="fas fa-fw fa-ruler"></i>
                    <span>Unidades de Medida</span>
                </a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="true" aria-controls="collapseMaster">
                    <i class="fas fa-fw fa-boxes"></i>
                    <span>Productos</span>
                </a>
                <div id="collapseMaster" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-light py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Administrar Productos :</h6>
                        <a class="collapse-item" href="<?= base_url('units'); ?>">Unidades de Medida</a>
                        <a class="collapse-item" href="<?= base_url('categories'); ?>">Categorías</a>
                        <a class="collapse-item" href="<?= base_url('products'); ?>">Productos</a>
                    </div>
                </div>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Transacciones
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('incoming_goods'); ?>">
                    <i class="fas fa-fw fa-truck-loading"></i>
                    <span>Productos Entrantes</span>
                </a>
            </li>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('outgoing_goods'); ?>">
                    <i class="fas fa-fw fa-truck"></i>
                    <span>Productos Salientes</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Reportes
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('reports'); ?>">
                    <i class="fas fa-fw fa-print"></i>
                    <span>Obtener Reporte</span>
                </a>
            </li>

            <?php if (is_admin()) : ?>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Configuración
                </div>

                <!-- Nav Item -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('users'); ?>">
                        <i class="fas fa-fw fa-user-cog"></i>
                        <span>Administrar Usuarios</span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-dark bg-primary topbar mb-4 static-top shadow-sm">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link bg-transparent d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars text-white"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-capitalize" style="color:azure;">
                                    <?= userdata('name'); ?>
                                </span>
                                <img class="img-profile rounded-circle" src="<?= base_url() ?>assets/img/avatar/<?= userdata('picture'); ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('profile'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="<?= base_url('profile/edit'); ?>">
                                    <i class="fas fa-pen fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Editar Perfil
                                </a>
                                <a class="dropdown-item" href="<?= base_url('profile/change_password'); ?>">
                                    <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cambiar Contraseña
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-power-off fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <?= $contents; ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-light">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span> &copy; Veico Tools <?php echo date("Y"); ?> &nbsp; &bull; &nbsp; Hecho con ❤️ por María y Luisanys</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro que quieres salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">Haz clic en 'Cerrar sesión' para salir del sistema.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-danger" href="<?= base_url('logout'); ?>">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('.date').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy-mm-dd'
            });

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#tangal').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            }

            $('#date').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Hoy': [moment(), moment()],
                    'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
                    'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
                    'Este mes': [moment().startOf('month'), moment().endOf('month')],
                    'Mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'Este año': [moment().startOf('year'), moment().endOf('year')],
                    'Año pasado': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                }
            }, cb);



            cb(start, end);
        });

        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                buttons: ['copy', 'csv', 'print', 'excel', 'pdf'],
                dom: "<'row px-2 px-md-4 pt-2'<'col-md-3'l><'col-md-5 text-center'B><'col-md-4'f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row px-2 px-md-4 py-3'<'col-md-5'i><'col-md-7'p>>",
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "All"]
                ],
                columnDefs: [{
                    targets: -1,
                    orderable: false,
                    searchable: false
                }]
            });

            table.buttons().container().appendTo('#dataTable_wrapper .col-md-5:eq(0)');

            // Check if a flash message is present
            var message_id = '<?= $this->session->flashdata('message_id'); ?>';
            if (message_id) {
                setTimeout(function() {
                    // Automatically remove the 'show' class to trigger the fade-out animation
                    $('#' + message_id).removeClass('show');
                    // Remove the flash message after the animation is complete
                    $('#' + message_id).on('transitionend', function() {
                        $(this).remove();
                    });
                }, 5000); // 5 seconds

            }
        });
    </script>

    <script type="text/javascript">
        let page = '<?= $this->uri->segment(1); ?>';

        let unit = $('#unit');
        let stock = $('#stock');
        let price = $('#price');
        let totalStock = $('#total_stock');
        let fixedPrice = $('#total_nominal');
        let totalNominalCart = $('#total_nominal_cart');
        let grandTotal = $('#grand_total');
        let quantity = page == 'incoming_goods' ? $('#quantity_in') : $('#quantity_out');

        $(document).on('change', '#id_item', function() {
            let url = '<?= base_url('products/getStock/'); ?>' + this.value;
            $.getJSON(url, function(data) {
                unit.html(data.unit_name);
                stock.val(data.stock);
                price.val(data.price);
                totalStock.val(data.stock);
                quantity.focus();
            });
        });

        $(document).on('keyup', '#quantity_in', function() {
            let updatedStock = parseInt(stock.val()) + parseInt(this.value);
            totalStock.val(Number(updatedStock));
        });

        $(document).on('keyup', '#quantity_out', function() {
            let updatedStock = parseInt(stock.val()) - parseInt(this.value);
            totalStock.val(Number(updatedStock));
        });

        $(document).on('keyup', '#quantity_out', function() {
            let updatedTotal = parseInt(price.val()) * parseInt(this.value);
            fixedPrice.val(Number(updatedTotal));
        });

        $(document).on('keyup', '#discount', function() {
            let updatedTotal = parseInt(totalNominalCart.val()) - parseFloat(this.value);
            grandTotal.val(Number(updatedTotal));
        });
    </script>

    <?php if ($this->uri->segment(1) == 'dashboard') : ?>
        <!-- Chart -->
        <script src="<?= base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>

        <script type="text/javascript">
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            function number_format(number, decimals, dec_point, thousands_sep) {
                // *     example: number_format(1234.56, 2, ',', ' ');
                // *     return: '1 234,56'
                number = (number + '').replace(',', '').replace(' ', '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function(n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };
                // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            }

            // Area Chart Example

            console.log("log incoming");
            console.log(<?= json_encode($monthly_incoming); ?>);

            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                    datasets: [{
                            label: "Entrantes",
                            lineTension: 0.3,
                            backgroundColor: "rgba(78, 115, 223, 0.05)",
                            borderColor: "rgba(78, 115, 223, 1)",
                            pointRadius: 3,
                            pointBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointBorderColor: "rgba(78, 115, 223, 1)",
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: "#5a5c69",
                            pointHoverBorderColor: "#5a5c69",
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                            data: <?= json_encode($monthly_incoming); ?>,
                        },
                        {
                            label: "Salientes",
                            lineTension: 0.3,
                            backgroundColor: "rgba(231, 74, 59, 0.05)",
                            borderColor: "#e74a3b",
                            pointRadius: 3,
                            pointBackgroundColor: "#e74a3b",
                            pointBorderColor: "#e74a3b",
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: "#5a5c69",
                            pointHoverBorderColor: "#5a5c69",
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                            data: <?= json_encode($monthly_outgoing); ?>,
                        }
                    ],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: 5
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 12
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                                // Include a dollar sign in the ticks
                                callback: function(value, index, values) {
                                    return number_format(value);
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                            }
                        }
                    }
                }
            });

            // Pie Chart 
            var ctx = document.getElementById("myPieChart");

            var incomingGoods = <?= $incoming_goods; ?>;
            var outgoingGoods = <?= $outgoing_goods; ?>;
            var datasets = [];
            var labels = [];

            if (incomingGoods === 0 && outgoingGoods === 0) {
                labels = ["Sin Transacciones"];
                datasets.push({
                    data: [1], // Set a gray placeholder value
                    backgroundColor: ['#ccc'], // Gray color for the placeholder
                    hoverBackgroundColor: ['#ccc'], // Gray color for the placeholder on hover
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                });
            } else {
                labels = ["Entrantes", "Salientes"];
                datasets = [{
                    data: [incomingGoods, outgoingGoods],
                    backgroundColor: ['#008c59', '#c53326'],
                    hoverBackgroundColor: ['#00aa6b', '#da4032'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }];
            }

            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: datasets,
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 80,
                },
            });
        </script>
    <?php endif; ?>

    <script>
        $(document).ready(function() {
            const navItems = $('.nav-item');
            const currentPage = 'http://localhost' + window.location.pathname;

            console.log(currentPage);
            // Check and apply the 'active-nav-item' class on page load
            navItems.each(function() {
                const link = $(this).find('a');
                const href = link.attr('href');

                console.log(href);
                if (currentPage.includes(href)) {
                    console.log("hello");
                    $(this).addClass('active-nav-item');
                    $(this).find('i, span').css('color', '#2b2f99');
                }
            });

            // Handle click events
            navItems.on('click', function() {
                // Remove the 'active-nav-item' class from all items
                navItems.removeClass('active-nav-item');

                // Add the 'active-nav-item' class to the clicked item
                $(this).addClass('active-nav-item');
            });

            if ($(".sidebar").hasClass("toggled")) {
                $(".sidebar-heading").css('padding', '0');
            } else {
                $(".sidebar-heading").css('padding', '0 1rem');
            }
        });
    </script>

</body>

</html>