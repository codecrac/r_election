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
                            <h3 class="text-white">{{round($nombre_total_votants/$nombre_total_inscrit *100,2)}}</h3>
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
                        <h4 class="card-title"> {{auth()->user()->election->nom}} </h4>
                        <h4 class="card-title"> Resulats {{auth()->user()->centre->zone->nom}} - {{auth()->user()->centre->nom}} </h4>
                    </div>
                    <div class="iq-card-header-toolbar d-flex align-items-center">
                    </div>
                </div>
                <div class="iq-card-body">
                    <div id="iq-product-chart" class="amcharts-chart-div" style="height: 400px;"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script_complemeantaire')
    <script>

        if(jQuery('#iq-product-chart').length){
            am4core.ready(function() {

                am4core.useTheme(am4themes_animated);

                var chart = am4core.create("iq-product-chart", am4charts.XYChart);
                chart.hiddenState.properties.opacity = 0;
                chart.colors.list = [
                    am4core.color("#1e3d73")
                ];

                chart.data = [{
                    "date": "2018-01-un-nom",
                    "steps": 4561
                }, {
                    "date": "2018-01-02",
                    "steps": 5687
                }, {
                    "date": "2018-01-03",
                    "steps": 6348
                }, {
                    "date": "2018-01-04",
                    "steps": 4878
                }, {
                    "date": "2018-01-05",
                    "steps": 9867
                }, {
                    "date": "2018-01-06",
                    "steps": 7561
                }, {
                    "date": "2018-01-07",
                    "steps": 1287
                }, {
                    "date": "2018-01-08",
                    "steps": 3298
                }, {
                    "date": "2018-01-09",
                    "steps": 5697
                }, {
                    "date": "2018-01-10",
                    "steps": 4878
                }, {
                    "date": "2018-01-11",
                    "steps": 8788
                }, {
                    "date": "2018-01-12",
                    "steps": 9560
                }, {
                    "date": "2018-01-13",
                    "steps": 11687
                }, {
                    "date": "2018-01-14",
                    "steps": 5878
                }, {
                    "date": "2018-01-15",
                    "steps": 9789
                }, {
                    "date": "2018-01-16",
                    "steps": 3987
                }, {
                    "date": "2018-01-17",
                    "steps": 5898
                }, {
                    "date": "2018-01-18",
                    "steps": 9878
                },  {
                    "date": "2018-01-31",
                    "steps": 3268
                }];

                chart.dateFormatter.inputDateFormat = "YYYY-MM-dd";
                chart.zoomOutButton.disabled = true;

                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.grid.template.strokeOpacity = 0;
                dateAxis.renderer.minGridDistance = 10;
                dateAxis.dateFormats.setKey("day", "d");
                dateAxis.tooltip.hiddenState.properties.opacity = 1;
                dateAxis.tooltip.hiddenState.properties.visible = true;


                dateAxis.tooltip.adapter.add("x", function (x, target) {
                    return am4core.utils.spritePointToSvg({ x: chart.plotContainer.pixelX, y: 0 }, chart.plotContainer).x + chart.plotContainer.pixelWidth / 2;
                })

                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.renderer.inside = true;
                valueAxis.renderer.labels.template.fillOpacity = 0.3;
                valueAxis.renderer.grid.template.strokeOpacity = 0;
                valueAxis.min = 0;
                valueAxis.cursorTooltipEnabled = false;

                // goal guides
                var axisRange = valueAxis.axisRanges.create();
                axisRange.value = 6000;
                axisRange.grid.strokeOpacity = 0.1;
                axisRange.label.text = "Goal";
                axisRange.label.align = "right";
                axisRange.label.verticalCenter = "bottom";
                axisRange.label.fillOpacity = 0.8;

                valueAxis.renderer.gridContainer.zIndex = 1;

                var axisRange2 = valueAxis.axisRanges.create();
                axisRange2.value = 12000;
                axisRange2.grid.strokeOpacity = 0.1;
                axisRange2.label.text = "2x goal";
                axisRange2.label.align = "right";
                axisRange2.label.verticalCenter = "bottom";
                axisRange2.label.fillOpacity = 0.8;

                var series = chart.series.push(new am4charts.ColumnSeries);
                series.dataFields.valueY = "steps";
                series.dataFields.dateX = "date";
                series.tooltipText = "{valueY.value}";
                series.tooltip.pointerOrientation = "vertical";
                series.tooltip.hiddenState.properties.opacity = 1;
                series.tooltip.hiddenState.properties.visible = true;
                series.tooltip.adapter.add("x", function (x, target) {
                    return am4core.utils.spritePointToSvg({ x: chart.plotContainer.pixelX, y: 0 }, chart.plotContainer).x + chart.plotContainer.pixelWidth / 2;
                })

                var columnTemplate = series.columns.template;
                columnTemplate.width = 30;
                columnTemplate.column.cornerRadiusTopLeft = 20;
                columnTemplate.column.cornerRadiusTopRight = 20;
                columnTemplate.strokeOpacity = 0;

                columnTemplate.adapter.add("fill", function (fill, target) {
                    var dataItem = target.dataItem;
                    if (dataItem.valueY > 6000) {
                        return chart.colors.getIndex(0);
                    }
                    else {
                        return am4core.color("#a8b3b7");
                    }
                })

                var cursor = new am4charts.XYCursor();
                cursor.behavior = "panX";
                chart.cursor = cursor;
                cursor.lineX.disabled = true;

                chart.events.on("datavalidated", function () {
                    dateAxis.zoomToDates(new Date(2018, 0, 21), new Date(2018, 1, 1), false, true);
                });

                var middleLine = chart.plotContainer.createChild(am4core.Line);
                middleLine.strokeOpacity = 1;
                middleLine.stroke = am4core.color("#000000");
                middleLine.strokeDasharray = "2,2";
                middleLine.align = "center";
                middleLine.zIndex = 1;
                middleLine.adapter.add("y2", function (y2, target) {
                    return target.parent.pixelHeight;
                })

                cursor.events.on("cursorpositionchanged", updateTooltip);
                dateAxis.events.on("datarangechanged", updateTooltip);

                function updateTooltip() {
                    dateAxis.showTooltipAtPosition(0.5);
                    series.showTooltipAtPosition(0.5, 0);
                    series.tooltip.validate(); // otherwise will show other columns values for a second
                }


                var label = chart.plotContainer.createChild(am4core.Label);
                label.text = "Pan chart to change date";
                label.x = 90;
                label.y = 50;

            });
        }
    </script>
@endsection
