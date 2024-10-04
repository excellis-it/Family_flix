


<div class="col-lg-12 mt-4">
        @php
            $url = 'https://myfamilycinema.com/en/download-my-family-cinema/';
            $content = file_get_contents($url);

            // Modify the content by removing header and footer (using regex, for example)
            $content = preg_replace('/<header.*?<\/header>/s', '', $content);
            $content = preg_replace('/<footer.*?<\/footer>/s', '', $content);

            echo $content;
        @endphp
        <iframe src="{{ $content }}" name="iframe_all" scrolling="yes" frameborder="0"
            height="0px" width="0px"></iframe>
    
</div>



@push('scripts')
    <script>
        var frame = document.querySelector("iframe");
        header = frame.contentDocument.querySelector("header");
        header.remove();
        footer = frame.contentDocument.querySelector("footer");
        footer.remove();
    </script>
@endpush