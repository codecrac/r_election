@extends('includes.base_admin')

@section('content')
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
                                <h4 class="card-title text-uppercase">{{$lelection->nom}}</h4>
                                {!! Session::get('notification','') !!}
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <table class="table table-bordered" >
                                <thead>
                                    <th class="text-center" style="width: 50%" >
                                        Candidat
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                            +
                                        </button>

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
                                    </th>
                                    <th class="text-center" style="width: 50%">Agent de bureau  <a href="#" class="btn btn-primary">+</a> </th>
                                </thead>
                                <tbody>
                                    <tr>
{{--                                        //candidat--}}
                                        <td>
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
                                        </td>
{{--                                        //agent de bureau--}}
                                        <td>
                                            <table id="datatable" class="table table-striped table-bordered" >
                                                <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Centre</th>
                                                    <th>#</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($liste_zones_de_vote as $item_zone)
                                                    <tr>
                                                        <td class="text-uppercase" >{{$item_zone->nom}}</td>
                                                        <td class="text-uppercase" >{{sizeof($item_zone->centres)}}</td>

                                                        <td>
                                                            <a href="#" class="btn btn-primary" > Gerer </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
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
