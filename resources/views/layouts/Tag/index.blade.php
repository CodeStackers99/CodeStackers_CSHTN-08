@extends('layouts.app')

@section('title', 'Tags | WebAcquire')

@section('content')

    <div class="d-flex flex-row justify-content-between section-divider">

        {{-- @include('layouts.partials._sidebar') --}}

        <div class="container">
            <div class="section courses reveal">
                <div class="d-flex flex-column col-md-16">
                    <div class="d-flex flex-column align-items-center">
                        <span class="my-underline-2"></span>
                        <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Tags</h2>
                    </div>

                    <div class="button d-flex justify-content-end">
                        <a
                            href="{{ route('tags.create') }}"
                            class="styled-btn styled-rounded text-muted border border-dark " style="text-decoration:none">
                            <span class="styled-button-text">Create tag</span>
                        </a>
                    </div>

                    <div class="section">
                        @if($tags->count() > 0)
                            <div>
                                @foreach ($tags as $tag)
                                    <div class="@if (! $loop->first) section @endif reveal">
                                        <div class="card d-flex my-card p-0 m-0 mb-4 @if (! $loop->first) @endif">
                                            <div class="card-body d-flex justify-content-between section-divider">
                                                <div>
                                                    <h4 class="mt-2 text-hblack faq-font font-weight-bolder">
                                                        <i class="fa fa-tag"></i> {{$tag->name}}
                                                    </h4>
                                                </div>
                                                <div>
                                                    @can('update', $tag)
                                                        <a
                                                            href="{{ route('tags.edit', $tag->id) }}"
                                                            class="btn btn-info">
                                                            Edit <i class="fa fa-edit fa-lg" ></i>
                                                        </a>
                                                    @endcan
                                                    @can('delete', $tag)
                                                    <button
                                                        class="btn btn-danger"
                                                        onclick="displayModalToDeleteTag({{ $tag->id }})"
                                                        data-toggle="modal"
                                                        data-target="#deleteModalForTag"
                                                        title="Delete your Tag">
                                                        Delete <i class="fa fa-trash fa-lg" ></i>
                                                    </button>
                                                @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            @include('layouts.Tag._no-tags-found')
                        @endif
                    </div>
                       <!--Delete Modal For Tag-->
                        @include('layouts.Tag._delete-modal')

                    <div class=" d-flex justify-content-center my-shadow ">
                        {{ $tags->appends(['search' => request('search')])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        function displayModalToDeleteTag(tagId) {
            console.log(tagId);
            var url = "/tags/" + tagId;
            $("#deleteTagForm").attr('action', url);
        }
    </script>
@endsection
