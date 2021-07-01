<?php
    require_once "../functions.php";
    session_start();
    
    if(isset($_SESSION['logued']) && $_SESSION['logued'] == true ){
        require_once "../database.php";
        ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CRUD PHP MySQL">
    <meta name="author" content="Damian Zsiros">
    <meta name="keywords" content="CRUD,PHP,MySQL,Damian Zsiros,Web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <?php include_once "./partials/head.php"?>
    <title>Products CRUD</title>

    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="./admin.php">
                    <span class="align-middle">Products CRUD</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Productos
                    </li>

                    <li class="sidebar-item ">
                        <a class="sidebar-link" href="./admin.php">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item ">
                        <button type="button" class="sidebar-link" data-bs-toggle="modal"
                            data-bs-target="#creatingCenteredModalPrimary">
                            <i class="fa fa-eyedropper" aria-hidden="true"></i><span class="align-middle">Insertar
                                productos</span>
                        </button>
            </div>
            <div class="modal fade" id="creatingCenteredModalPrimary" tabindex="-2" role="dialog" aria-hidden="true">
                <form action="../app/insertar.php" method="POST">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Insertar producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body m-3">
                                <div class="mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" class="form-control" name="createName" placeholder="Nombre"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Descripcion</label>
                                    <input type="text" class="form-control" name="createDescription"
                                        placeholder="Descripcion" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Precio</label>
                                    <input type="number" class="form-control" placeholder="Precio" name="createPrecio"
                                        required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Insertar</button>
                            </div>
                        </div>
                </form>
            </div>
            </li>
            </ul>

    </div>
    </nav>

    <div class="main">
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <a class="sidebar-toggle js-sidebar-toggle">
                <i class="hamburger align-self-center"></i>
            </a>

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align">
                    <li class="nav-item dropdown">
                        <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                            <div class="position-relative">
                                <i class="align-middle" data-feather="bell"></i>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                            aria-labelledby="alertsDropdown">
                            <div style="height: 350px; overflow-y: scroll;">
                                <div class="list-group">
                                    <?php
                                    if (isset($_SESSION['notifications'])) {
                                       for ($i=sizeof($_SESSION['notifications'])-1; $i >= 0 ; $i--) { 
                                            ?>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-warning" data-feather="bell"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-muted small mt-1">
                                                    <?php echo $_SESSION['notifications'][$i]?></div>
                                            </div>
                                        </div>
                                    </a>
                                    <?php
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                            <div class="dropdown-menu-footer">
                                <a href="#" class="text-muted">Mostrar todas las notificaciones</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                            <i class="align-middle" data-feather="settings"></i>
                        </a>

                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                            <img src="https://image.flaticon.com/icons/png/512/16/16363.png"
                                class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span
                                class="text-dark"><?php echo $_SESSION['user_info']['username']?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="../app/logout.php">Log out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="content">
            <div class="container-fluid p-0">
                <div class="row mb-4 px-3">
                    <?php
                                if (isset($_SESSION['message']) && isset($_SESSION['type'])) {
                                    ?>
                    <div class="alert alert-<?php echo $_SESSION['type']?> alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-message">
                            <?php echo $_SESSION['message']?>
                        </div>
                    </div>
                    <?php
                                unset($_SESSION['message']);
                                unset($_SESSION['type']);
                                }
                            
                            ?>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Todos los productos</h5>
                            </div>
                            <table class="table table-hover my-0">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Precio</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            
        
                                        $sql = "SELECT * FROM products";
                                        $result = mysqli_query($con,$sql);
                                        while ($product = mysqli_fetch_assoc($result)) {
        
                                                ?>
                                    <tr>
                                        <td><?php echo $product['name']?></td>
                                        <td><?php echo $product['description']?></td>
                                        <td><?php echo $product['price']?> COP</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#centeredModalPrimary<?php echo $product['id']?>">
                                                <i class="fa fa-eyedropper" aria-hidden="true"></i>
                                            </button>
                                            <div class="modal fade" id="centeredModalPrimary<?php echo $product['id']?>"
                                                tabindex="-1" role="dialog" aria-hidden="true">
                                                <form action="../app/editar.php" method="POST">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Editar producto</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="alert" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body m-3">
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $product['id']?>">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Nombre</label>
                                                                    <input type="text" class="form-control"
                                                                        name="newName" placeholder="Nombre"
                                                                        value="<?php echo $product['name']?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Descripcion</label>
                                                                    <input type="text" class="form-control"
                                                                        name="newDescription" placeholder="Descripcion"
                                                                        value="<?php echo $product['description']?>"
                                                                        required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Precio</label>
                                                                    <input type="number" class="form-control"
                                                                        placeholder="Precio" name="newPrecio"
                                                                        value="<?php echo $product['price']?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cerrar</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Editar</button>
                                                            </div>
                                                        </div>
                                                </form>
                                            </div>
                        </div>
                        <a href="../app/eliminar.php?id=<?php echo $product['id']?>" class="btn btn-danger"><i
                                class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                        </tr>
                        <?php
                                            }
                                        
                                        ?>

                        </tbody>
                        </table>
                    </div>
                </div>
            </div>

    </div>


    <div class="row">


    </div>
    </main>

    </div>
    </div>

    <script src="js/app.js"></script>
    <?php include "./partials/footer.php"?>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
        var gradient = ctx.createLinearGradient(0, 0, 0, 225);
        gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
        gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
        // Line chart
        new Chart(document.getElementById("chartjs-dashboard-line"), {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                    "Dec"
                ],
                datasets: [{
                    label: "Sales ($)",
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: window.theme.primary,
                    data: [
                        2115,
                        1562,
                        1584,
                        1892,
                        1587,
                        1923,
                        2566,
                        2448,
                        2805,
                        3438,
                        2917,
                        3327
                    ]
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    intersect: false
                },
                hover: {
                    intersect: true
                },
                plugins: {
                    filler: {
                        propagate: false
                    }
                },
                scales: {
                    xAxes: [{
                        reverse: true,
                        gridLines: {
                            color: "rgba(0,0,0,0.0)"
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 1000
                        },
                        display: true,
                        borderDash: [3, 3],
                        gridLines: {
                            color: "rgba(0,0,0,0.0)"
                        }
                    }]
                }
            }
        });
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pie chart
        new Chart(document.getElementById("chartjs-dashboard-pie"), {
            type: "pie",
            data: {
                labels: ["Chrome", "Firefox", "IE"],
                datasets: [{
                    data: [4306, 3801, 1689],
                    backgroundColor: [
                        window.theme.primary,
                        window.theme.warning,
                        window.theme.danger
                    ],
                    borderWidth: 5
                }]
            },
            options: {
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                cutoutPercentage: 75
            }
        });
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Bar chart
        new Chart(document.getElementById("chartjs-dashboard-bar"), {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                    "Dec"
                ],
                datasets: [{
                    label: "This year",
                    backgroundColor: window.theme.primary,
                    borderColor: window.theme.primary,
                    hoverBackgroundColor: window.theme.primary,
                    hoverBorderColor: window.theme.primary,
                    data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                    barPercentage: .75,
                    categoryPercentage: .5
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        stacked: false,
                        ticks: {
                            stepSize: 20
                        }
                    }],
                    xAxes: [{
                        stacked: false,
                        gridLines: {
                            color: "transparent"
                        }
                    }]
                }
            }
        });
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var markers = [{
                coords: [31.230391, 121.473701],
                name: "Shanghai"
            },
            {
                coords: [28.704060, 77.102493],
                name: "Delhi"
            },
            {
                coords: [6.524379, 3.379206],
                name: "Lagos"
            },
            {
                coords: [35.689487, 139.691711],
                name: "Tokyo"
            },
            {
                coords: [23.129110, 113.264381],
                name: "Guangzhou"
            },
            {
                coords: [40.7127837, -74.0059413],
                name: "New York"
            },
            {
                coords: [34.052235, -118.243683],
                name: "Los Angeles"
            },
            {
                coords: [41.878113, -87.629799],
                name: "Chicago"
            },
            {
                coords: [51.507351, -0.127758],
                name: "London"
            },
            {
                coords: [40.416775, -3.703790],
                name: "Madrid "
            }
        ];
        var map = new jsVectorMap({
            map: "world",
            selector: "#world_map",
            zoomButtons: true,
            markers: markers,
            markerStyle: {
                initial: {
                    r: 9,
                    strokeWidth: 7,
                    stokeOpacity: .4,
                    fill: window.theme.primary
                },
                hover: {
                    fill: window.theme.primary,
                    stroke: window.theme.primary
                }
            },
            zoomOnScroll: false
        });
        window.addEventListener("resize", () => {
            map.updateSize();
        });
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
        var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
        document.getElementById("datetimepicker-dashboard").flatpickr({
            inline: true,
            prevArrow: "<span title=\"Previous month\">&laquo;</span>",
            nextArrow: "<span title=\"Next month\">&raquo;</span>",
            defaultDate: defaultDate
        });
    });
    </script>

</body>

</html>
<?php
    }else{
        header("Location: ../index.php");
    }
?>