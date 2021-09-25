@extends('layouts.app')

@section('title', 'Admin Panel | WebAcquire')

@section('content')

<div class="container">
    <div class="section d-flex flex-column align-items-center">
        <span class="my-underline-2"></span>
        <h2 class="text-hblack font-weight-bold text-capitalize mt-3 animate_animated animate__heartBeat animate_slow sub-heading">Manage Teachers</h2>
    </div>
    <div class="section d-flex mb-2 justify-content-between reveal">
        <div class="button ">
            <a
                href="{{ route('dashboard') }}"
                class="styled-btn styled-rounded text-muted border border-dark" style="text-decoration:none">
                <span class="styled-button-text"><i class="fa fa-chevron-circle-left" ></i> Back to Dashboard</span>
            </a>
        </div>
    </div>
    <div class="section">
        @if($users->count() > 0)
            <div>
                @foreach ($users as $user)
                    <div class="@if (! $loop->first) section @endif reveal">
                        <div class="card d-flex my-card p-0 m-0 mb-4 @if (! $loop->first) @endif">
                            <div class="card-body d-flex justify-content-between section-divider">
                                    <div>
                                        <h5 class="mt-2 text-hblack  faq-font">
                                            <strong class="text-orange mr-2">{{$loop->iteration}}. </strong> <img src="{{$user->image_path}}" alt="" height="100px" width="100px"> <strong class="text-orange">{{ $user->name}}</strong>
                                            <strong class="text-hblack ml-2"> Registered: {{$user->created_at->diffForHumans()}}</strong>
                                        </h5>
                                    </div>

                                    <div>
                                        <form action="{{route('user.teachers.status', $user->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-hblack">{{$user->approval_status ? 'Disapprove' : 'Approve'}}</button>
                                        </form>
                                        <img src="{{$user->verification_path}}" alt="" height="100px" width="100px">
                                    </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            @include('layouts.Quiz._no-quiz-found')
        @endif
    </div>
</div>
@endsection

@section('scripts')

<script>
    new RevealScroll($(".reveal"), "60%");
</script>


@endsection

