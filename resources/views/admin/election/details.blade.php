@extends('includes.base_admin')

@section('content')
{{--    AJOUTER DES BUREAUX--}}
    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{$lelection->nom}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="{{route('zone.creer')}}" >
                        <div class="form-group">
                            <input name="id_election" class="form-control" value="{{$lelection->id}}" type="hidden" />

                            <label for="email">Importer le fichier de la liste des bureaux <small>
                                    <br/>
                                    <a href="#"><u>telecharger exemple de fichier</u></a></small> </label>
                            <br/>
                            <input type="file" class="form-control" name="fichier_centre_de_vote" id="email1" required>
                        </div>
                        <br/>
                        <p class="text-center">
                            @csrf
                            <button type="submit" style="width: 150px" class="btn btn-primary">Enregistrer</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <a href="{{route('election.liste')}}"> <h6 class="card-title"> <i style="font-size: 25px" class="ri-arrow-left-s-line iq-arrow-left"></i> Retour à la liste </h6> </a>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <br/>
                                    {!! Session::get('notification','') !!}
                                <br/>
                                <h4 class="card-title text-uppercase">
                                    {{$lelection->nom}}
                                    &nbsp;&nbsp;&nbsp;
                                    <i class="fa fa-edit" onclick="toggle_div_modifier()"></i>
                                    &nbsp;&nbsp;&nbsp;
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter2">
                                        Importer la liste des bureaux de votes
                                    </button>
                                </h4>

                                <br/>
                                <div class="row" id="div_modifier" style="display: none" >
                                    <form method="post">

                                        <div class="row pl-3">
                                            <div class="col-6">
                                                <input name="nom" class="form-control" value="{{$lelection->nom}}" />
                                            </div>
                                            <div class="col-4">
                                                <select class="form-control" name="etat" >
                                                    <option {{$lelection->etat == 'attente' ? 'selected' : '' }} value="attente" > EN ATTENTE </option>
                                                    <option {{$lelection->etat == 'en cours' ? 'selected' : '' }}  value="en cours" > EN COURS </option>
                                                    <option {{$lelection->etat == 'termine' ? 'selected' : '' }}  value="termine" > TERMINE </option>
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                @csrf
                                                <input class="btn btn-primary" type="submit" value="Appliquer"  />
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <br/>
                            </div>
                        </div>
                        <div class="iq-card-body">

                                        {{-- CANDIDATS                            --}}
                                        <p class="text-center">
                                            Candidats
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                                +
                                            </button>
                                        </p>
                                        {{-- AJOUTER CANDIDATS                            --}}
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <form method="post" action="{{route('election.enregistrer_candidat',[$lelection->id])}}" >

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="email">Nom du candidat<small><i>(Separer par des virgules pour enregistrer plusieurs a la fois)</i></small> </label>
                                                                    <input name="nom" class="form-control" id="email1" required>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            @csrf
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                            <button type="submit" style="width: 150px" class="btn btn-primary">Enregistrer</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>



                                        <table class="table table-striped">
                                            <thead>
                                            <th> Nom</th>
                                            <th> #</th>
                                            </thead>
                                            <tbody>
                                            @foreach($lelection->candidats as $item_candidat)
                                                <tr>
                                                    <td>{{$item_candidat->nom}}</td>
                                                    <td>#</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    <hr/>
                                        <p class="text-center">Resultat de bureau </p>
                                    <hr/>


                            <div class="col-sm-12">
                                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                    <div class="iq-card-header d-flex justify-content-between">
                                        <div class="iq-header-title">
                                            <h4 class="card-title"> Resulats Toutes Regions </h4>
                                        </div>
                                        <div class="iq-card-header-toolbar d-flex align-items-center">
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        <div id="iq-chart-order" class="amcharts-chart-div" style="height: 400px;"></div>
                                    </div>
                                </div>
                            </div>

                                    <table class="table table-striped">
                                        <thead>
                                        <th> Zone</th>
                                        <th> Nom</th>
                                        <th> Stats</th>
                                        <th> Resultats</th>
{{--                                        <th> #</th>--}}
                                        </thead>
                                        <tbody>
                                        @foreach($liste_centre as $item_centre)
                                            <tr>
                                                <td>{{$item_centre->zone->nom}}</td>
                                                <td>
                                                    {{$item_centre->nom}}
                                                    <br/>
                                                    Chef de service : {{$item_centre->chef_de_service->name}}<br/>
                                                    Telephone : {{$item_centre->chef_de_service->telephone ?? '-'}}<br/>
                                                </td>
                                                <td>
                                                    Inscrits : {{number_format($item_centre->electeurs_inscrit($lelection->id),0,'',' ')}} <br/>
                                                    Votants :  {{number_format($item_centre->nombre_total_votants($lelection->id),0,'',' ')}} <br/>
                                                    Nuls : {{number_format($item_centre->nombre_bulletins_nuls($lelection->id),0,'',' ')}} <br/>
                                                    Blancs :  {{number_format($item_centre->nombre_bulletins_blanc($lelection->id),0,'',' ')}} <br/>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach($lelection->candidats as $item_candidat)
                                                            <li>
                                                                {{$item_candidat->nom}} :
                                                                {{number_format($item_candidat->nombre_de_voix_en_tout_le_centre($item_centre->id),0,'',' ') }}
                                                                ({{round($item_candidat->nombre_de_voix_en_tout_le_centre($item_centre->id) /($item_centre->nombre_total_votants($lelection->id) == 0? 1: $item_centre->nombre_total_votants($lelection->id)) *100,2)}}%)
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
{{--                                                <td>#</td>--}}
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                        </div>
                    </div>
                </div>
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

        function toggle_div_modifier(){
            var la_div = document.getElementById('div_modifier');
            if(la_div.style.display == 'none'){
                la_div.style.display = 'block';
            }else{
                la_div.style.display = 'none';
            }
        }

    </script>
@endsection
