@extends('customer.layouts.master')
@section('title')
    Dashboard
@endsection
@push('styles')
    <style>
        #page-container {
            height: 750px;
            overflow-y: auto !important;
        }
    </style>
@endpush
@section('head')
    Dashboard
@endsection
@section('content') 


<div class="col-lg-12 mt-4">
    <div style="height:1500px;">
        @php
            $url = 'https://myfamilycinema.com/en/download-my-family-cinema/';
            $content = file_get_contents($url);

            // Modify the content by removing header and footer (using regex, for example)
            $content = preg_replace('/<header.*?<\/header>/s', '', $content);
            $content = preg_replace('/<footer.*?<\/footer>/s', '', $content);

            echo $content;
        @endphp
        <iframe src="{{ $content }}" name="iframe_all" scrolling="yes" frameborder="0"
            height="100px" width="200px"></iframe>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        var frame = document.querySelector("iframe");
        header = frame.contentDocument.querySelector("header");
        header.remove();
        footer = frame.contentDocument.querySelector("footer");
        footer.remove();
    </script>
@endpush