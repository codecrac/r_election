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
{{--                                <h4 class="card-title">Taux de participation </h4>--}}
                                <h4 class="card-title">Electeurs </h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            {!! Session::get('notification','') !!}
                            <form method="post" >
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-1" ></div>
                                        <div class="col-3"> <label >Nombres electeurs Inscrits</label> </div>
                                        <div class="col-4"> <input type="number" value="{{ auth()->user()->centre->electeurs_inscrit(auth()->user()->election_id)}}" name="nombre_electeurs_inscrits" class="form-control" id="email1" required></div>
                                    </div>
                                    <br/>
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
        </div>
    </div>
    </div>
@endsection
