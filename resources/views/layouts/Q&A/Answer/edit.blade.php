@extends('layouts.app')
@section('title', 'Edit Answer | WebAcquire')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="p-0 m-0 ml-2">Edit Answer</h1>
                <div class="card my-card p-0 m-0 mt-3 mb-5">
                        <div class="card-body">
                            <form action="{{ route('questions.answers.update',[$question->id, $answer->id]) }}" method="POST" id="edit-answer-form">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <input type="hidden" id="body" name="body" value="{{ old('body', $answer->body) }}">
                                    <trix-editor input="body" class="form-control  @error('body') is-invalid @enderror " ></trix-editor>
                                    @error('body')
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
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js" integrity="sha512-2RLMQRNr+D47nbLnsbEqtEmgKy67OSCpWJjJM394czt99xj3jJJJBQ43K7lJpfYAYtvekeyzqfZTx2mqoDh7vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $("#edit-answer-form").validate({
            rules: {
                title: {
                    required: true,
                    maxlength: 60
                },
                body: {
                    required: true
                }
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
    <script>
        window.addEventListener("trix-file-accept", function(event) {
        event.preventDefault()
        alert("File attachment not supported!")
    })
        let trixHeadingTag = $('.trix-button--icon-heading-1');
        trixHeadingTag.attr('data-trix-attribute', '');
        trixHeadingTag.attr('title', 'disabled');
        trixHeadingTag.attr('id', 'not-allowed');

    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
