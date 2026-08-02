@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Edition</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Modifier une édition</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.edition.update',$edition->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Titre</label>
                                    <input type="text" class="form-control" name="title"  value="{{$edition->titre}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control" name="date" value="{{$edition->date}}">
                                </div>
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$edition->status == 1 ? 'selected':''}} value="1">Actif</option>
                              <option {{$edition->status == 0 ? 'selected':''}} value="0">Inactif</option>
                            </select>
                        </div> --}}
                        <button type="submmit" class="btn btn-primary">Modifier</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>
@endsection
