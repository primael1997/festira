@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Editions</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Tableau de board</a></div>
                <div class="breadcrumb-item"><a href="#">Edition</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Liste des Editions</h2>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Editions</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.edition.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>#</th>
                                        <th>Titre</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    @forelse ($editions as $key=>$edition)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$edition->titre}}</td>
                                        <td>{{ Carbon\Carbon::parse($edition->date)->format('d-M-Y') }}</td>
                                        <td>
                                            @if ($edition->status == 1)
                                                <label class="custom-switch mt-2">
                                                    <input type="checkbox" checked name="custom-switch-checkbox" data-id="{{$edition->id}}" class="custom-switch-input change-status" >
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            @else
                                                <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="custom-switch-checkbox" data-id="{{$edition->id}}" class="custom-switch-input change-status">
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="buttons text-center">
                                                <a href="{{route('admin.edition.edit',$edition->id)}}" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                                <a href="{{route('admin.edition.destroy',$edition->id)}}" class="btn btn-icon btn-danger delete-item"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="6">Pas d'édition</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                            {!! $editions->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('body').on('click', '.change-status', function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{route('admin.edition.change-status')}}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data){
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })

            })
        })
    </script>
@endpush
