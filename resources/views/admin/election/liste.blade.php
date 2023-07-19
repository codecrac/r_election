@extends('includes.base_admin')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Elections <a href="{{route('election.creer')}}" class="btn btn-primary" >Creer Une Nouvelle Election</a> </h4>
                    </div>
                </div>
                <div class="iq-card-body">
{{--                    <p>Images in Bootstrap are made responsive with <code>.img-fluid</code>. <code>max-width: 100%;</code> and <code>height: auto;</code> are applied to the image so that it scales with the parent element.</p>--}}
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Etat</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($liste_election as $item_election)
                                <tr>
                                    <td class="text-uppercase" >{{$item_election->nom}}</td>
                                    <td class="text-center" >
                                        <span style="width: 100px" class="badge badge-{{$item_election->etat == 'attente' ? 'secondary' :( $item_election->etat == 'en cours' ? 'primary' : 'success' )  }} text-uppercase" >
                                            {{$item_election->etat}}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{route('election.details',[$item_election->id])}}" class="btn btn-primary" > Gerer </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
