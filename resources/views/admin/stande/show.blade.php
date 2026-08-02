@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Demande de stande</h1>
        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4>Logo de la structure</h4>
                                        </div>
                                        <div class="card-body">
                                            <p><img src="{{asset($stand->logo)}}" alt="" height="80"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="card card-secondary">
                                        <div class="card-header">
                                            <h4>Piece d'identité du responsable</h4>
                                        </div>
                                        <div class="card-body">
                                            <p><img src="{{asset($stand->piece_identite)}}" alt="" height="80"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <td>Nom du responsable: </td>
                                        <td>{{ $stand->nom }}</td>
                                    </tr>
                                    <tr>
                                        <td>Prénom du responsable: </td>
                                        <td>{{ $stand->prenom }}</td>
                                    </tr>
                                    <tr>
                                        <td>Sexe: </td>
                                        <td>{{ $stand->sexe }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nom de la structure: </td>
                                        <td>{{ $stand->structure }}</td>

                                    </tr>
                                    <tr>
                                        <td>Secteur: </td>
                                        <td>{{ $stand->secteur }}</td>

                                    </tr>
                                    <tr>
                                        <td>Télephone de la structure: </td>
                                        <td>{{ $stand->phone }}</td>


                                    </tr>
                                    <tr>
                                        <td>Email de la structure: </td>
                                        <td>{{ $stand->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Adresse: </td>
                                        <td>{{ $stand->adresse }}</td>
                                    </tr>
                                    <tr>
                                        <td>Présentation activité: </td>
                                        <td><a target="_blank" href="{{route('admin.stande.presentation',$stand->id)}}"><img src="{{asset('admin/assets/img/PDF_file_icon.svg.webp')}}" alt="" height="80"></a></td></td>
                                    </tr>

                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">
                                    <div class="col-md-4">
                                        <form action="{{route('admin.valide.stande',$stand->id)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="">Action</label>
                                                <select name="status" class="form-control">
                                                    <option selected>--Selectionner le status--</option>
                                                    <option value="validé">Valider</option>
                                                    <option value="rejetté">Rejetté</option>
                                                </select>
                                            </div>
                                            <button class="btn btn-primary" type="submit"> Modifier</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

