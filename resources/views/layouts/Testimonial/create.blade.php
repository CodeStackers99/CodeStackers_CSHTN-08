@extends('layouts.app')
@section('title', 'Rate Us | WebAcquire')
@section('content')
<div class="container">
    <div class="row justify-content-center" id="ask-question">
        <div class="col-md-12">
            <div class="section d-flex flex-column align-items-center">
                <span class="my-underline-2"></span>
                <h2 class="text-hblack font-weight-bold text-capitalize mt-3 animate_animated animate__heartBeat animate_slow sub-heading">Add Ratings</h2>
            </div>
            <div class="card my-card p-0 m-0 mt-3 mb-5">
                    <div class="card-body">
                        <form action="{{ route('testimonials.store') }}" method="POST" id="create-review-form">
                            @csrf
                            <div class="form-group">
                                <strong style="font-size: 25px;">Enter Your Thoughts</strong>
                                <textarea
                                    name="description"
                                    id="description"
                                    rows="6"
                                    class="form-control  @error('description') is-invalid @enderror" >{{old('description')}}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <strong style="font-size: 25px;">Rate Out Of 5</strong>
                                <div class="slidecontainer">
                                    <input type="range" min="1" max="5" value="4" class="slider" id="ratings" name="ratings">
                                    <strong id="ratings-text"></strong>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" >Submit</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

    <script>
        $("#create-review-form").validate({
            rules: {
                description: {
                    required: true,
                    maxlength: 80
                },
                ratings: {
                    required: true,
                    minlength: 1,
                    maxlength: 5
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
        var slider = document.getElementById("ratings");
        var output = document.getElementById("ratings-text");
        output.innerHTML = "Good";
        output.classList = 'd-block';
        output.classList.add('text-primary');

        slider.oninput = function() {
            if(this.value == 1){
                output.innerHTML = "Very Bad";
                output.classList = 'd-block';
                output.classList.add('text-danger');
            } else if(this.value == 2){
                output.innerHTML = "Bad";
                output.classList = 'd-block';
                output.classList.add('text-orange');
            } else if(this.value == 3){
                output.innerHTML = "Average";
                output.classList = 'd-block';
                output.classList.add('text-warning');
            } else if(this.value == 4){
                output.innerHTML = "Good";
                output.classList = 'd-block';
                output.classList.add('text-primary');
            } else if(this.value == 5){
                output.innerHTML = "Excellent";
                output.classList = 'd-block';
                output.classList.add('text-success');
            }
        }
    </script>

@endsection
