@extends('includes.base_admin')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                       <a href="{{route('zone.liste')}}"> <h6 class="card-title"> <i style="font-size: 25px" class="ri-arrow-left-s-line iq-arrow-left"></i> Retour à la liste </h6> </a>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Creer Un Bureau</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
{{--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p>--}}
                            {!! Session::get('notification','') !!}
                            <form method="post" enctype="multipart/form-data" >
                                <div class="form-group">
                                    <label >Election concernee </label>
                                    <select name="id_election" class="form-control" required>
                                        @foreach($liste_election as $item_selection)
                                            <option value="{{$item_selection->id}}" > {{$item_selection->nom}} </option>
                                        @endforeach
                                    </select>
                                    <br/>
                                    <label for="email">Importer un fichier <small><a href="#"><u>telecharger exemple de fichier</u></a></small> </label>
                                    <br/>
                                    <input type="file" name="fichier_centre_de_vote" id="email1" required>
                                </div>
                                <br/>
{{--                                <div class="form-group">--}}
{{--                                    <label for="email">Nom <small><i>(Separer par des virgules pour enregistrer plusieurs a la fois)</i></small> </label>--}}
{{--                                    <input name="nom" class="form-control" id="email1" required>--}}
{{--                                </div>--}}
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
