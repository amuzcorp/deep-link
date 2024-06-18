@extends('deep-link::layout')
@section('content')
    <h2>실행</h2>
    <p>런!</p>

    <script type="text/javascript">
        function runApp() {
            let shortLinkId = '{{ $linkContextHistory->short_link }}';
            let timeOutInterval = 500;
            if (navigator.userAgent.match(/iPhone|iPad|iPod/)) {
                window.location.href = '{{ config('deep-link.app.ios.bundle') }}://?shortLinkId=' + shortLinkId;
                setTimeout(() => {
                    window.location.href = '{{ route(config('deep-link.app.ios.install_route')) }}';
                }, timeOutInterval);
            } else if (navigator.userAgent.match(/Android/)) {
                window.location.href = 'intent://{{ config('deep-link.app.android.name') }}?shortLinkId=' + shortLinkId + '#Intent;scheme={{ config('deep-link.app.android.package') }};package={{ config('deep-link.app.android.package') }};end';
                setTimeout(() => {
                    window.location.href = '{{ route(config('deep-link.app.andoird.install_route')) }}';
                }, timeOutInterval);
            }else{
                setTimeout(() => {
                    window.location.href = '{{ route(config('deep-link.app.default.install_route')) }}';
                }, timeOutInterval);
            }
        }
    </script>
@endsection
