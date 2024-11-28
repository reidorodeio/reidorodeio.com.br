@if (!is_null($general->embed))
    <div class="banner-area">
        <iframe width="100%" id="videoFrame" src="{{ $general->embed }}" title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>

    <script>
        function resizeIframe() {
            var iframe = document.getElementById('videoFrame');
            var screenWidth = window.innerWidth;
            if (screenWidth < 768) {
                iframe.style.height = '315px';
            } else {
                iframe.style.height = '720px';
            }
        }
        resizeIframe();
        window.addEventListener('resize', resizeIframe);
    </script>
@endif

<div class="banner-area">
    <div class="banner-slider owl-carousel">
        @foreach ($slider as $data)
            <div class="item">
                <img src="{{ asset('public/images/slider/' . $data->image) }}" alt="img">
            </div>
        @endforeach
    </div>
</div>
