@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Vendor Request</h1>
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
                                            <p><img src="{{asset($sponsort->logo)}}" alt="" height="80"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <td>Nom du responsable: </td>
                                        <td>{{ $sponsort->responsable }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nom de la structure: </td>
                                        <td>{{ $sponsort->name }}</td>

                                    </tr>
                                    <tr>
                                        <td>Secteur: </td>
                                        <td>{{ $sponsort->secteur }}</td>

                                    </tr>
                                    <tr>
                                        <td>Télephone: </td>
                                        <td>{{ $sponsort->phone }}</td>


                                    </tr>
                                    <tr>
                                        <td>Email: </td>
                                        <td>{{ $sponsort->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Adresse: </td>
                                        <td>{{ $sponsort->adresse }}</td>
                                    </tr>
                                    <tr>
                                        <td>Message: </td>
                                        <td>{{$sponsort->message}}</td>
                                    </tr>

                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">
                                    <div class="col-md-4">
                                        <form action="{{route('admin.valide.sponsort',$sponsort->id)}}" method="POST">
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

