@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Actualités</h1>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.posts.update',$post->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Titre de l'actualités<b class="text-danger">*</b></label>
                                <input type="text" class="form-control" name="title" value="{{$post->title}}">
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label>Description (maximum 300 caractères) <b class="text-danger">*</b></label>
                                    <textarea name="description" class="form-control" cols="30" rows="50">{{$post->description}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label>Contenu <b class="text-danger">*</b></label>
                                    <textarea name="content" class="form-control summernote" cols="30" rows="50">{{$post->content}}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Catégorie <b class="text-danger">*</b></label>
                                        <select name="category" class="form-control">
                                            @foreach ($categories as $category)
                                                <option {{$post->category_id == $category->id ? 'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image <b class="text-danger">*</b></label>
                                        <input type="file" class="form-control" name="image">
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
