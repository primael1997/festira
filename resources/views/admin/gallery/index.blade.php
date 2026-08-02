@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Galleries</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Tableau de board</a></div>
                <div class="breadcrumb-item"><a href="#">Galleries</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Galleries</h2>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Galleries</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive gallery gallery-md">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>#</th>
                                        <th>image</th>

                                        <th class="text-center">Action</th>
                                    </tr>
                                    @forelse ($images as $key=>$image)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>
                                                <div class="gallery-item"
                                                    data-image="{{asset($image->images)}}"
                                                    data-title="Image 1"
                                                    href="{{asset($image->images)}}"
                                                    title="Image 1"
                                                    style="background-image: url(&quot;{{asset($image->images)}}&quot;);">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="buttons text-center">
                                                    <a href="{{ route('admin.galleries.destroy',$image->id) }}"
                                                        class="btn btn-icon btn-danger delete-item"><i
                                                            class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>


                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="6">Pas d'image dans la gallerie</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>

                        </div>

                        <div class="row">
                            <form action="{{route('admin.galleries.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Image <code>(supporte plusieurs images)</code></label>
                                    <input type="file" name="image[]" class="form-control" multiple>
                                    <input type="hidden" name="product">
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
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
