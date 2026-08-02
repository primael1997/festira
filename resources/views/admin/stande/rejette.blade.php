@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Standes</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Tableau de board</a></div>
                <div class="breadcrumb-item"><a href="#">Standes Rejetés</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Liste de standes rejettés</h2>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Les Stands</h4>
                            <div class="card-header-action d-flex align-items-center gap-2">
                                {{-- <label for=""><i class="fas fa-filter" style="font-size: 150%"></i></label> --}}
                                <form action="{{ route('admin.stande.rejette') }}" method="GET">
                                    <select name="edition" class="form-control" onchange="this.form.submit()">
                                        <option value="">Toutes les éditions</option>
                                        @foreach($editions as $edition)
                                            <option value="{{ $edition->id }}"
                                                {{ request('edition') == $edition->id ? 'selected' : '' }}>
                                                {{ $edition->titre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                                <a href="{{route('admin.standes.create')}}" class="ml-2 btn btn-primary"><i class="fas fa-plus"></i> Ajouter</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Prénoms</th>
                                        <th>Sexe</th>
                                        <th>Edition</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    @forelse ($stands as $key=>$stand)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$stand->nom}}</td>
                                        <td>{{$stand->prenom}}</td>
                                        <td>{{$stand->sexe}}</td>
                                        <td>
                                            <div class="badge badge-warning">
                                                {{$stand->edition->titre}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="badge badge-danger">
                                                {{$stand->etude}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="buttons text-center">
                                                <a href="{{route('admin.standes.show',$stand->id)}}" class="btn btn-icon btn-primary"><i class="far fa-eye"></i></a>
                                                <a href="{{route('admin.standes.destroy',$stand->id)}}" class="btn btn-icon btn-danger delete-item"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="6">Pas de stande</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                            {!! $stands->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

