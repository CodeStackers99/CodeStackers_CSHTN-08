@extends('layouts.app')

@section('title', 'Edit Tag | WebAcquire')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex flex-column align-items-center">
                    <span class="my-underline-2"></span>
                    <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Edit Tag</h2>
                </div>
                <div class="card my-card p-0 m-0 mt-3 mb-5">
                        <div class="card-body">
                            <form action="{{ route('tags.update', $tag->id) }}" method="POST" id="edit-tag-form" >
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name of Tag</label>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', $tag->name) }}"
                                        class="form-control  @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning" >Edit Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
               </div>
         </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#edit-tag-form").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 40
                },
            },
            errorElement: 'p',
            errorPlacement: function(error, element) {
                if (error) {
                    error.insertAfter(element);
                    error.addClass('text-danger');
                }
            }
        });
    </script>
@endsection
