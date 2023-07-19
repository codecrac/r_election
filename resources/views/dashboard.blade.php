@extends('includes.base_admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <h4 class="text-center text-uppercase" ><b>{{$nom_election_en_cours}}</b></h4>
            <br/>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-primary rounded">
                <div class="iq-card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="icon iq-icon-box rounded iq-bg-primary rounded shadow" data-wow-delay="0.2s">
                            <i class="las la-users"></i>
                        </div>
                        <div class="iq-text">
                            <h6 class="text-white">Inscrits</h6>
                            <h3 class="text-white">{{$nombre_total_inscrit}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-success rounded">
                <div class="iq-card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="icon iq-icon-box rounded iq-bg-success rounded shadow" data-wow-delay="0.2s">
                            <i class="las la-user-tie"></i>
                        </div>
                        <div class="iq-text">
                            <h6 class="text-white">Votants</h6>
                            <h3 class="text-white">{{$nombre_total_votants}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-warning rounded">
                <div class="iq-card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="icon iq-icon-box rounded iq-bg-warning rounded shadow" data-wow-delay="0.2s">
                            <i class="lab la-product-hunt"></i>
                        </div>
                        <div class="iq-text">
                            <h6 class="text-white">% Participation</h6>
                            <h3 class="text-white">{{round($nombre_total_votants/($nombre_total_inscrit == 0? 1: $nombre_total_inscrit) *100,2)}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-danger rounded">
                <div class="iq-card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="icon iq-icon-box rounded iq-bg-danger rounded shadow" data-wow-delay="0.2s">
                            <i class="lab la-buffer"></i>
                        </div>
                        <div class="iq-text">
                            <h6 class="text-white">Bullettins</h6>
                            <h3 class="text-white"><small>blanc :{{$nombre_total_bulletin_nuls}}</small></h3>
                            <h3 class="text-white"><small>Nuls : {{$nombre_total_bulletin_blancs}}</small></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title"> {{ $is_admin ? ($lelection_en_cours !=null ? $lelection_en_cours->nom : '-') :  auth()->user()->election->nom}} </h4>
                        <h4 class="card-title"> Resulats {{$is_admin ? 'Toutes Regions' :  auth()->user()->centre->zone->nom .' - '. auth()->user()->centre->nom}} </h4>
                    </div>
                    <div class="iq-card-header-toolbar d-flex align-items-center">
                    </div>
                </div>
                <div class="iq-card-body">
                    <div id="iq-chart-order" class="amcharts-chart-div" style="height: 400px;"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script_complemeantaire')
    <script>

        var liste_candidat = @json($tableau_stats_votes);
        // alert(liste_candidat);

        if(jQuery('#iq-chart-order').length){
            am4core.ready(function() {

                am4core.useTheme(am4themes_animated);

                var chart = am4core.create("iq-chart-order", am4charts.XYChart);
                // chart.colors.list = [
                    // am4core.color("#1e3d73"),
                    // am4core.color("#fe517e"),
                    // am4core.color("#99f6ca"),
                    // am4core.color("#ffbf43"),
                    // am4core.color("#9267ff"),
                    // am4core.color("#1e3d73"),
                    // am4core.color("#fe517e"),
                    // am4core.color("#99f6ca"),
                    // am4core.color("#ffbf43"),
                    // am4core.color("#9267ff"),
                    // am4core.color("#1e3d73"),
                    // am4core.color("#fe517e")
                // ];

                // chart.data = [{
                //     "country": "Yves Khalil",
                //     "visits": 4848
                // }, {
                //     "country": "South Korea",
                //     "visits": 443
                // }, {
                //     "country": "Canada",
                //     "visits": 441
                // }];

                chart.data = liste_candidat;

                chart.padding(40, 40, 40, 40);

                var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                categoryAxis.renderer.grid.template.location = 0;
                categoryAxis.dataFields.category = "country";
                categoryAxis.renderer.minGridDistance = 60;
                categoryAxis.renderer.inversed = true;
                categoryAxis.renderer.grid.template.disabled = true;

                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.min = 0;
                valueAxis.extraMax = 0.1;
                //valueAxis.rangeChangeEasing = am4core.ease.linear;
                //valueAxis.rangeChangeDuration = 1500;

                var series = chart.series.push(new am4charts.ColumnSeries());
                series.dataFields.categoryX = "country";
                series.dataFields.valueY = "visits";
                series.tooltipText = "{valueY.value}"
                series.columns.template.strokeOpacity = 0;
                series.columns.template.column.cornerRadiusTopRight = 10;
                series.columns.template.column.cornerRadiusTopLeft = 10;
                //series.interpolationDuration = 1500;
                //series.interpolationEasing = am4core.ease.linear;
                var labelBullet = series.bullets.push(new am4charts.LabelBullet());
                labelBullet.label.verticalCenter = "bottom";
                labelBullet.label.dy = -10;
                labelBullet.label.text = "{values.valueY.workingValue.formatNumber('#.')}";

                chart.zoomOutButton.disabled = true;

                // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
                series.columns.template.adapter.add("fill", function (fill, target) {
                    return chart.colors.getIndex(target.dataItem.index);
                });


                categoryAxis.sortBySeries = series;

            });
        }
    </script>
@endsection
