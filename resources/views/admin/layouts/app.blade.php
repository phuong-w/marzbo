<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/x-icon" href="{{ asset('storage/img/favicon.ico') }}" />
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/github.min.css">

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <style>
            .as-button {
                border: none;
                background-color: inherit;
            }

            .ql-align {
                line-height: initial;
            }

            .bubble p {
                color: inherit !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .bubble pre {
                background-color: lavender;
                padding: 16px;
            }
        </style>
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />

        <!-- Styles -->
        @vite([
        'resources/css/app.css',
        'resources/js/app.js',

        'resources/sass/assets/authentication/form-2.scss',

        'resources/sass/plugins/lightbox/custom-photswipe.scss',
        'resources/sass/plugins/lightbox/photoswipe.scss',

        'resources/sass/assets/loader.scss',
        'resources/sass/assets/plugins.scss',
        'resources/sass/plugins/perfect-scrollbar/perfect-scrollbar.scss',
        'resources/sass/assets/forms/theme-checkbox-radio.scss',
        'resources/sass/assets/components/custom-modal.scss'
        ])
{{--        <script src="{{ asset('assets/js/loader.js') }}"></script>--}}
        @routes
        @inertiaHead
    </head>
    <body>
        @inertia

        <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
{{--        <script src="{{ asset('assets/js/app.js') }}"></script>--}}
        <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('plugins/editors/markdown/simplemde.min.js') }}"></script>
        <script src="{{ asset('plugins/editors/markdown/custom-markdown.js') }}"></script>
        <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>

        <script src="{{ asset('plugins/dropify/dropify.min.js') }}"></script>
        <script src="{{ asset('plugins/blockui/jquery.blockUI.min.js') }}"></script>
        <script src="{{ asset('assets/js/users/account-settings.js') }}"></script>
        <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>

{{--        <script>--}}
{{--            $(document).ready(function() {--}}
{{--                App.init();--}}
{{--            });--}}
{{--        </script>--}}
        <script src="https://cdn.jsdelivr.net/highlight.js/latest/highlight.min.js"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>

    </body>
</html>
