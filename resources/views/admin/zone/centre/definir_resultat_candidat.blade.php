@extends('includes.base_admin')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
{{--                        <a href="{{route('dashboard')}}"> <h6 class="card-title"> <i style="font-size: 25px" class="ri-arrow-left-s-line iq-arrow-left"></i> Retour au tableau de bord </h6> </a>--}}
                        <h6 class="card-title">
                            {{auth()->user()->election->nom}}
                            <br/>
                            {{auth()->user()->centre->zone->nom}} - {{auth()->user()->centre->nom}}
                        </h6>
                    </div>
                </div>
                <div class="iq-card-body">

                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <form>
                                        <a href="?"> <span class="card-title"> <i style="font-size: 25px" class="ri-arrow-left-s-line iq-arrow-left"></i> Retour </span> </a>
                                        <h4 class="card-title text-center">
                                            Resultats decompte du
                                            @if(!$date_decompte)
                                                <input name="d" type="date" value="{{date('Y-m-d')}}">
                                                <input type="submit" value="definir les resultats">
                                            @else
                                                {{date('d/m/Y',strtotime($date_decompte))}}
                                            @endif
                                        </h4>
                                    </form>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                    {!! Session::get('notification','') !!}

                                    @if($date_decompte)
                                        <form method="post" >
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">

                                                            <div class="col-6">
                                                                 <label >Bulletins Nuls</label>
                                                                 <input type="number" value="{{ $participation_existant == null ? '' : $participation_existant->bulletin_null}}" name="nb_bulletins_nuls" class="form-control" id="email1" required>
                                                            </div>
                                                            <br/>
                                                            <div class="col-6">
                                                                <label >Bulletins Blanc </label>
                                                                <input type="number" value="{{ $participation_existant == null ? '' : $participation_existant->bulletin_blanc}}" name="nb_bulletins_blancs" class="form-control" id="email1" required>
                                                            </div>
                                                        </div>
                                                        <br/>
                                                        <hr/>
                                                    </div>
                                                    <div class="col-1" ></div>
                                                    @foreach($liste_candidats_de_leclection as $item_candidat)
                                                        <div class="col-3 p-4 table-bordered m-1">
                                                            <div class="col-12 text-center" >
                                                                <img width="50" src="https://static.vecteezy.com/system/resources/previews/002/318/271/original/user-profile-icon-free-vector.jpg" class="img-fluid rounded mr-3" alt="user">
                                                            </div>
                                                            <h4 class="text-center" >{{$item_candidat->nom}}</h4>
                                                            <br/>
                                                            <div>
                                                                <label>Nombre de voix</label> <br/>
                                                                <input type="hidden" class="form-control" name="id_candidat[]" value="{{$item_candidat->id}}" />
                                                                <input class="form-control" name="nombre_de_voix[]" value="{{$item_candidat->nombre_de_voix_centre_date(auth()->user()->centre_id,$date_decompte)}}" />
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <br/>
                                            <p class="text-center">
                                                @csrf
                                                <input type="hidden" class="form-control" name="election_id" value="{{auth()->user()->election_id}}" />
                                                <input type="hidden" class="form-control" name="id_centre" value="{{auth()->user()->centre_id}}" />
                                                <input  type="hidden" name="date_decompte" value="{{date('Y-m-d',strtotime($date_decompte))}}">
                                                <button type="submit" style="width: 150px" class="btn btn-primary">Enregistrer</button>
                                            </p>
                                        </form>
                                    @endif
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
