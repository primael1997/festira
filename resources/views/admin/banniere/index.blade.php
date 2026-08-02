@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Bannieres</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Tableau de board</a></div>
                <div class="breadcrumb-item"><a href="#">Banniere</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Liste des Bannieres</h2>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Bannieres</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.banniere.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>#</th>
                                        <th width="300">Banniere</th>
                                        <th>Titre</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    @forelse ($baners as $key=>$baner)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>
                                            <x-cloudinary::image public-id="{{ $baner->public_id }}" width="80" height="80" class="img-fluid" />
                                        </td>
                                        <td>{{$baner->title}}</td>
                                        <td>{{$baner->description}}</td>
                                        <td>
                                            @if ($baner->status == 1)
                                                <label class="custom-switch mt-2">
                                                    <input type="checkbox" checked name="custom-switch-checkbox" data-id="{{$baner->id}}" class="custom-switch-input change-status" >
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            @else
                                                <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="custom-switch-checkbox" data-id="{{$baner->id}}" class="custom-switch-input change-status">
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="buttons text-center">
                                                <a href="{{route('admin.banniere.edit',$baner->id)}}" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                                <a href="{{route('admin.banniere.destroy',$baner->id)}}" class="btn btn-icon btn-danger delete-item"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="6">Pas de banniere</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
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
                    url: "{{route('admin.banniere.change-status')}}",
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
