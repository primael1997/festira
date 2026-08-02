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
                    <h4>Ajouter une édition</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.edition.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Titre</label>
                                    <input type="text" class="form-control" name="title"  value="{{old('title')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control" name="date" value="{{old('date')}}">
                                </div>
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option value="1">Actif</option>
                              <option value="0">Inactif</option>
                            </select>
                        </div> --}}
                        <button type="submmit" class="btn btn-primary">Ajouter</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>
@endsection
