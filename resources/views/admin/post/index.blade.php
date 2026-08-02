@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Catégories Actualités</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Tableau de board</a></div>
                <div class="breadcrumb-item"><a href="#">Poste</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Liste des publications</h2>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Liste des publications</h4>
                            <div class="card-header-action d-flex align-items-center gap-2">

                                <a href="{{ route('admin.posts.create') }}" class="ml-2 btn btn-primary"><i
                                        class="fas fa-plus"></i> Ajouter</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Titre</th>
                                        <th>Catégorie</th>

                                        <th class="text-center">Action</th>
                                    </tr>
                                    @forelse ($posts as $key=>$post)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td><img src="{{asset($post->image)}}" alt="" width="80" height="80"></td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->category->name }}</td>

                                            <td>
                                                <div class="buttons text-center">
                                                    <a href="" class="btn btn-icon btn-primary"><i
                                                            class="far fa-eye"></i>
                                                    </a>
                                                    <a href="{{route('admin.posts.edit',$post->id)}}" class="btn btn-icon btn-success"><i
                                                            class="far fa-edit"></i>
                                                    </a>
                                                    <a href="{{route('admin.posts.destroy',$post->id)}}"
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
                            {!! $posts->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
