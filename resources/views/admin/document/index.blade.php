@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Documents</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Tableau de board</a></div>
                <div class="breadcrumb-item"><a href="#">Documents</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Liste des documents</h2>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Liste des documents</h4>
                            <div class="card-header-action d-flex align-items-center gap-2">

                                <a href="{{ route('admin.documents.create') }}" class="ml-2 btn btn-primary"><i
                                        class="fas fa-plus"></i> Ajouter</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>#</th>
                                        <th>Icone</th>
                                        <th>Titre</th>
                                        <th>Catégorie</th>

                                        <th class="text-center">Action</th>
                                    </tr>
                                    @forelse ($documents as $key=>$doc)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td><i class="fas fa-file"></i></td>
                                            <td>{{ $doc->title }}</td>
                                            <td>{{ $doc->category_document->name }}</td>

                                            <td>
                                                <div class="buttons text-center">
                                                    <a target="_blank" href="{{route('admin.documents.show',$doc->slug)}}" class="btn btn-icon btn-primary"><i
                                                            class="far fa-eye"></i>
                                                    </a>
                                                    <a href="{{route('admin.documents.edit',$doc->id)}}" class="btn btn-icon btn-success"><i
                                                            class="far fa-edit"></i>
                                                    </a>
                                                    <a href="{{route('admin.documents.destroy',$doc->id)}}"
                                                        class="btn btn-icon btn-danger delete-item"><i
                                                            class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>


                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="6">Pas de poste</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                            {!! $documents->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
