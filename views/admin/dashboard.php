<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <div class="row">

        <!-- Total de Citas -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total de Citas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo 120; // Ejemplo de citas ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ingresos Totales -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ingresos Totales</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$<?php echo 3400; // Ejemplo de ingresos ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Servicio Más Popular -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Servicio Más Popular</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "Cardiología"; // Ejemplo de servicio ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-stethoscope fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Citas de Hoy -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Citas de Hoy</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo 5; // Ejemplo de citas de hoy ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Gráficos -->
    <div class="row">

        <!-- Gráfico de Citas Mensuales -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Citas por Mes</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="citasMensualesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Ingresos Mensuales -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ingresos por Mes</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie">
                        <canvas id="ingresosMensualesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Scripts para los gráficos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Ejemplo de datos para el gráfico de Citas Mensuales
    const citasMensualesCtx = document.getElementById('citasMensualesChart').getContext('2d');
    const citasMensualesChart = new Chart(citasMensualesCtx, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            datasets: [{
                label: 'Citas',
                data: [10, 12, 15, 13, 18, 20, 25, 23, 17, 22, 19, 16], // Datos ficticios
                borderColor: 'rgba(78, 115, 223, 1)',
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                borderWidth: 2
            }]
        },
        options: {
            maintainAspectRatio: false
        }
    });

    // Ejemplo de datos para el gráfico de Ingresos Mensuales
    const ingresosMensualesCtx = document.getElementById('ingresosMensualesChart').getContext('2d');
    const ingresosMensualesChart = new Chart(ingresosMensualesCtx, {
        type: 'doughnut',
        data: {
            labels: ['Consulta General', 'Especialidad', 'Laboratorio'],
            datasets: [{
                data: [1500, 1200, 700], // Datos ficticios
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc']
            }]
        },
        options: {
            maintainAspectRatio: false,
            cutoutPercentage: 80
        }
    });
</script>
