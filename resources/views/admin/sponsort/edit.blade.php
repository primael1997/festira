@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Sponsorts</h1>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.sponsort.update',$sponsort->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nom et Prénom du responsable<b class="text-danger">*</b></label>
                                        <input type="text" class="form-control" name="nom" value="{{$sponsort->responsable}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nom de la structure <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control" name="structure" value="{{$sponsort->name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Télephone <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control" name="phone" value="{{$sponsort->phone}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputState">Secteur <b class="text-danger">*</b></label>
                                        <select id="inputState" class="form-control" name="secteur">
                                            <option {{$sponsort->secteur == 'Informatique' ? 'selected' : ''}} value="Informatique">Informatique</option>
                                            <option {{$sponsort->secteur == 'Télécommunications' ? 'selected' : ''}} value="Télécommunications">Télécommunications</option>
                                            <option {{$sponsort->secteur == 'Banque' ? 'selected' : ''}} value="Banque">Banque</option>
                                            <option {{$sponsort->secteur == 'Assurance' ? 'selected' : ''}} value="Assurance">Assurance</option>
                                            <option {{$sponsort->secteur == 'Agroalimentaire' ? 'selected' : ''}} value="Agroalimentaire">Agroalimentaire</option>
                                            <option {{$sponsort->secteur == 'BTP' ? 'selected' : ''}} value="BTP">BTP</option>
                                            <option {{$sponsort->secteur == 'Santé' ? 'selected' : ''}} value="Santé">Santé</option>
                                            <option {{$sponsort->secteur == 'Éducation' ? 'selected' : ''}} value="Éducation">Éducation</option>
                                            <option {{$sponsort->secteur == 'Commerce' ? 'selected' : ''}} value="Commerce">Commerce</option>
                                            <option {{$sponsort->secteur == 'Transport' ? 'selected' : ''}} value="Transport">Transport</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email <b class="text-danger">*</b></label>
                                        <input type="email" class="form-control" name="email" value="{{$sponsort->email}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Logo <b class="text-danger">*</b></label>
                                        <input type="file" class="form-control" name="logo">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Adresse <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control" name="adresse" value="{{$sponsort->adresse}}">
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submmit" class="btn btn-primary">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
