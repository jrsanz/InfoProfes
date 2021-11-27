<x-dashboard>
    <div class="container">
        <div class="row mx-3 my-5 d-flex justify-content-center shadow py-3 rounded" style="background-color: #f0f0f0;">
            <div class="col-lg-3 rounded d-flex justify-content-between py-3 align-items-center my-2 bg-success bg-gradient">
                <div class="ms-3">
                    <h3>{{ $usuarios }}</h3>
                    <h6>Usuarios</h6>
                </div>
                <div class="bg-white rounded-circle me-3">
                    <i class="fs-2 bi-person px-2"></i>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1 rounded d-flex justify-content-between py-3 align-items-center my-2 bg-info bg-gradient"">
                <div class="ms-3">
                    <h3>{{ $profesores }}</h3>
                    <h6>Profesores</h6>
                </div>
                <div class="bg-white rounded-circle me-3">
                    <i class="fs-2 bi-person-video3 px-2"></i>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1 rounded d-flex justify-content-between py-3 align-items-center my-2 bg-danger bg-gradient"">
                <div class="ms-3">
                    <h3>{{ $calificaciones }}</h3>
                    <h6>Calificaciones</h6>
                </div>
                <div class="bg-white rounded-circle me-3">
                    <i class="fs-2 bi-bar-chart px-2"></i>
                </div>
            </div>
        </div>
        <div class="row justify-content-between mx-2">
            <div class="col-md-6 my-3">
                <div class="shadow rounded" id="profesores_verificados"></div>
            </div>
            <div class="col-md-6 my-3">
                <div class="shadow rounded" id="profesores_cu"></div>
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <script>
            Highcharts.chart('profesores_verificados', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Profesores Registrados'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                        }
                    }
                },
                series: [{
                    name: 'Brands',
                    colorByPoint: true,
                    data: <?= $verificados ?>
                }]
            });

            Highcharts.chart('profesores_cu', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Distribución De Profesores Por CU'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                        }
                    }
                },
                series: [{
                    name: 'Brands',
                    colorByPoint: true,
                    data: <?= $centro_univ ?>
                }]
            });
        </script>
    </x-slot>
</x-dashboard>