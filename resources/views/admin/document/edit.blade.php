@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Documents</h1>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.documents.update',$file->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Titre du document<b class="text-danger">*</b></label>
                                <input type="text" class="form-control" name="title" value="{{$file->title}}">
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label>Description (maximum 300 caractères) <b class="text-danger">*</b></label>
                                    <textarea name="description" class="form-control" cols="30" rows="50">{{$file->description}}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Catégorie <b class="text-danger">*</b></label>
                                        <select name="category" class="form-control">
                                            @foreach ($categories as $category)
                                                <option {{$file->category_document_id == $category->id ? 'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Image </label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Document <b class="text-danger">*</b></label>
                                        <input type="file" class="form-control" name="doc">
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
