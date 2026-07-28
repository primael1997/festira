@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Banniere</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Ajouter une banniere</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.banniere.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Banniere</label>
                            <input type="file" class="form-control" name="banner">
                        </div>
                        <div class="form-group">
                            <label>Titre</label>
                            <input type="text" class="form-control" name="title"  value="{{old('title')}}">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" class="form-control" name="description"  value="{{old('description')}}"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Button Url</label>
                            <input type="text" class="form-control" name="btn_url" value="{{old('btn_url')}}">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option value="1">Actif</option>
                              <option value="0">Inactif</option>
                            </select>
                          </div>
                        <button type="submmit" class="btn btn-primary">Ajouter</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>
@endsection
