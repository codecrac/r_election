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
                                <h4 class="card-title">Creer Une Election</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
{{--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p>--}}
                            {!! Session::get('notification','') !!}
                            <form method="post" >
                                <div class="form-group">
                                    <label for="email">Nom</label>
                                    <input name="nom" class="form-control" id="email1" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Statut</label>
                                    <select name="etat" class="form-control" id="pwd" required>
                                        <option>ATTENTE</option>
                                        <option>EN COURS</option>
                                        <option>TERMINEE</option>
                                    </select>
                                </div>
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
