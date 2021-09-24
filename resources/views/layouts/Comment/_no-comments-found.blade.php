<div class=" section d-flex flex-row justify-content-center align-items-center section-divider">
    <div class="text">
        <h2><strong class="text-hblack text-capitalize text-center sub-heading">No Comment found :(</strong></h2>
        @auth
            <div class="button text-center">
                <a
                    href="#comment-now"
                    class="scroll-to-comment-now styled-btn styled-rounded text-muted border border-dark p-1" style="text-decoration:none">
                    <span class="styled-button-text">Comment</span>
                </a>
            </div>
        @endauth
    </div>
    <img src="{{asset('images/others/not_found.png')}}" alt="No-Results-Found" class="no-result-found-img">
</div>
