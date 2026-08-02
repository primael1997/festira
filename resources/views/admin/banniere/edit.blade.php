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
                    <h4>Modifier une banniere</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.banniere.update',$baner->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <x-cloudinary::image public-id="{{ $baner->public_id }}" width="80" height="80" class="img-fluid" />
                        </div>
                        <div class="form-group">
                            <label>Banniere</label>
                            <input type="file" class="form-control" name="banner">
                        </div>
                        <div class="form-group">
                            <label>Titre</label>
                            <input type="text" class="form-control" value="{{$baner->title}}" name="title">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" class="form-control" name="description"  value="{{old('description')}}">{{$baner->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Button Url</label>
                            <input type="text" class="form-control" name="btn_url" value="{{$baner->btn_url}}">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$baner->status == 1 ? 'selected':''}} value="1">Actif</option>
                              <option {{$baner->status == 0 ? 'selected':''}} value="0">Inactif</option>
                            </select>
                          </div>
                        <button type="submmit" class="btn btn-primary">Modifier</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>
@endsection
