@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Gestion des Utilisateurs</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Tableau de board</a></div>
                <div class="breadcrumb-item"><a href="#">Utilisateurs</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Liste des Utilisateurs</h2>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Liste des Utilisateurs</h4>
                            <div class="card-header-action d-flex align-items-center gap-2">

                                <a type="button" data-toggle="modal" data-target="#addUser"
                                    href="{{ route('admin.category.create') }}" class="ml-2 btn btn-primary"><i
                                        class="fas fa-plus"></i> Ajouter</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Email</th>

                                        <th class="text-center">Action</th>
                                    </tr>
                                    @forelse ($users as $key=>$user)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>

                                            <td>
                                                <div class="buttons text-center">
                                                    <a type="button" data-toggle="modal" data-target="#editUser-{{$user->id}}" href="" class="btn btn-icon btn-success"><i
                                                            class="far fa-edit"></i></a>
                                                    <a href="{{route('admin.users.destroy',$user->id)}}"
                                                        class="btn btn-icon btn-danger delete-item"><i
                                                            class="fas fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>


                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="6">Pas d'utilisateur</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                            {!! $users->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Ajouter Utilisateur --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="addUser">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un utilisateur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.users.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nom <b class="text-danger">*</b></label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        </div>

                        <div class="form-group">
                            <label>Email <b class="text-danger">*</b></label>
                            <input type="email" class="form-control" name="email" value="{{old('email')}}">
                        </div>

                        <div class="form-group">
                            <label>Rôle <b class="text-danger">*</b></label>
                            <select name="role" class="form-control">
                                <option selected>Choisir le rôle</option>
                                <option value="0">Utilisateur</option>
                                <option value="1">Administrateur</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modifier Utilisateur --}}
    @foreach ($users as $user)
    <div class="modal fade" tabindex="-1" role="dialog" id="editUser-{{$user->id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier un utilisateur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @php
                    $use = \App\Models\User::where('id',$user->id)->first();
                @endphp
                <form action="{{route('admin.users.update',$use->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nom <b class="text-danger">*</b></label>
                            <input type="text" class="form-control" name="name" value="{{$use->name}}">
                        </div>

                        <div class="form-group">
                            <label>Email <b class="text-danger">*</b></label>
                            <input type="email" class="form-control" name="email" value="{{$use->email}}">
                        </div>

                        <div class="form-group">
                            <label>Rôle <b class="text-danger">*</b></label>
                            <select name="role" class="form-control">
                                <option {{$use->isAdmin == 0 ? 'selected':''}} value="0">Utilisateur</option>
                                <option {{$use->isAdmin == 1 ? 'selected':''}} value="1">Administrateur</option>
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endsection
