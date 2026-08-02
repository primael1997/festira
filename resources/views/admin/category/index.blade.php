@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Catégories Actualités</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Tableau de board</a></div>
                <div class="breadcrumb-item"><a href="#">Catégories</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Liste des Catégories</h2>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Liste des Catégories</h4>
                            <div class="card-header-action d-flex align-items-center gap-2">

                                <a type="button" data-toggle="modal" data-target="#addCategory"
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

                                        <th class="text-center">Action</th>
                                    </tr>
                                    @forelse ($categories as $key=>$category)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $category->name }}</td>

                                            <td>
                                                <div class="buttons text-center">
                                                    <a type="button" data-toggle="modal" data-target="#editCategory-{{$category->id}}" href="" class="btn btn-icon btn-success"><i
                                                            class="far fa-edit"></i></a>
                                                    <a href="{{ route('admin.category.destroy', $category->id) }}"
                                                        class="btn btn-icon btn-danger delete-item"><i
                                                            class="fas fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>


                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="6">Pas de catégorie</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                            {!! $categories->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Ajouter Catégory --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="addCategory">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une Catégorie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.category.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nom <b class="text-danger">*</b></label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
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

    {{-- Modifier Catégory --}}
    @foreach ($categories as $category)
    <div class="modal fade" tabindex="-1" role="dialog" id="editCategory-{{$category->id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier une Catégorie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @php
                    $cat = \App\Models\Category::where('id',$category->id)->first();
                @endphp
                <form action="{{route('admin.category.update',$cat->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nom <b class="text-danger">*</b></label>
                            <input type="text" class="form-control" name="name" value="{{$cat->name}}">
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
