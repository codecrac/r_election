@extends('includes.base_admin')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">
                            Zone et bureaux de votes <a href="{{route('zone.creer')}}" class="btn btn-primary" >Creer Un Nouveau Bureau</a>
                        </h4>
                    </div>
                </div>
                <div class="iq-card-body">
{{--                    <p>Images in Bootstrap are made responsive with <code>.img-fluid</code>. <code>max-width: 100%;</code> and <code>height: auto;</code> are applied to the image so that it scales with the parent element.</p>--}}
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Centre</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($liste_zone as $item_zone)
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
