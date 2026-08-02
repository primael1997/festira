@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Standes</h1>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Information Personne Physique</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.standes.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nom <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control" name="nom" value="{{old('nom')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Prénom <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control" name="prenom" value="{{old('prenom')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputState">Sexe <b class="text-danger">*</b></label>
                                        <select id="inputState" class="form-control" name="sexe">
                                            <option value="Masculin">Masculin</option>
                                            <option value="Féminin">Féminin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Photo piece d'identité <b class="text-danger">*</b></label>
                                        <input type="file" class="form-control" name="piece">
                                    </div>
                                </div>
                            </div>

                            <h5>Information de la structure</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nom <b class="text-danger">*</b> </label>
                                        <input type="text" class="form-control" name="structure">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputState">Secteur <b class="text-danger">*</b></label>
                                        <select id="inputState" class="form-control" name="secteur">
                                            <option value="Informatique">Informatique</option>
                                            <option value="Télécommunications">Télécommunications</option>
                                            <option value="Banque">Banque</option>
                                            <option value="Assurance">Assurance</option>
                                            <option value="Agroalimentaire">Agroalimentaire</option>
                                            <option value="BTP">BTP</option>
                                            <option value="Santé">Santé</option>
                                            <option value="Éducation">Éducation</option>
                                            <option value="Commerce">Commerce</option>
                                            <option value="Transport">Transport</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Télephone <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email <b class="text-danger">*</b></label>
                                        <input type="email" class="form-control" name="email" value="{{old('email')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ville <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control" name="ville" value="{{old('ville')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Adresse <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control" name="adresse" value="{{old('adresse')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Logo <b class="text-danger">*</b></label>
                                        <input type="file" class="form-control" name="logo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Présentation de vos produits <b class="text-danger">* (pdf)</b></label>
                                        <input type="file" class="form-control" name="presentation">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submmit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
