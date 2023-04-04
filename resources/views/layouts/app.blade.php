<!DOCTYPE html>
<html>
    <head>
        <!-- Basic Page Needs -->
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- Favicons -->
        <link rel="shortcut icon" href="frontend-assets/agency7/images/favicon.ico">
        <!-- FONTS -->
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Inter:100,200,300,400,400italic,500,600,700,700italic,900'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,400italic,500,600,700,700italic,900'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,400italic,500,600,700,700italic,900'>
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('frontend-assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <!--CSS -->
        <link href="{{ asset('frontend-assets/agency7/css/structure.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend-assets/agency7/css/agency7.css') }}" rel="stylesheet">
        <!-- Revolution Slider -->
        <link href="{{ asset('frontend-assets/plugins/rs-plugin-6.custom/css/rs6.css') }}" rel="stylesheet">
        @vite(['resources/js/app.js'])

        @routes
        @inertiaHead
    </head>
    <body class="home page theme-betheme woocommerce-no-js template-slider content-brightness-light input-brightness-light button-custom layout-full-width if-zoom hide-love no-shadows header-transparent header-fw sticky-header sticky-tb-color ab-hide subheader-both-center menu-line-below menuo-right menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-sticky mobile-icon-user-ss mobile-icon-wishlist-ss mobile-icon-cart-ss mobile-icon-search-ss mobile-icon-wpml-ss mobile-icon-action-ss be-page-8 be-reg-2518 mobile-row-2-products mfn-variable-swatches product-zoom-disabled shop-sidecart-active mfn-ajax-add-to-cart">
        @inertia

    <div id="body_overlay"></div>
    <div id="Side_slide" class="right light" data-width="250">
        <div class="close-wrapper"> <a href="#" class="close"><i class="icon-cancel-fine"></i></a> </div>

        <div class="menu_wrapper"></div>
    </div>
    <!-- JS -->
    <script src="{{ asset('frontend-assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/jquery-migrate-3.4.0.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/mfn.menu.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/jquery.plugins.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/jquery.jplayer.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/animations/animations.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/translate3d.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/scripts.js') }}"></script>
    <script src="{{ asset('frontend-assets/plugins/rs-plugin-6.custom/js/revolution.tools.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/plugins/rs-plugin-6.custom/js/rs6.min.js') }}"></script>
    <script type="text/javascript">
        var revapi1, tpj;

        function revinit_revslider11() {
            jQuery(function() {
                tpj = jQuery;
                revapi1 = tpj("#rev_slider_1_1");
                if(revapi1 == undefined || revapi1.revolution == undefined) {
                    revslider_showDoubleJqueryError("rev_slider_1_1");
                } else {
                    revapi1.revolution({
                        sliderLayout: "fullwidth",
                        visibilityLevels: "1240,1240,778,778",
                        gridwidth: "1400,1400,778,778",
                        gridheight: "950,950,1100,1100",
                        spinner: "spinner12",
                        perspective: 600,
                        perspectiveType: "global",
                        spinnerclr: "#13d5ff",
                        editorheight: "950,768,1100,720",
                        responsiveLevels: "1240,1240,778,778",
                        progressBar: {
                            disableProgressBar: true
                        },
                        navigation: {
                            onHoverStop: false
                        },
                        fallbacks: {
                            allowHTML5AutoPlayOnAndroid: true
                        },
                    });
                }
            });
        } // End of RevInitScript
        var once_revslider11 = false;
        if(document.readyState === "loading") {
            document.addEventListener('readystatechange', function() {
                if((document.readyState === "interactive" || document.readyState === "complete") && !once_revslider11) {
                    once_revslider11 = true;
                    revinit_revslider11();
                }
            });
        } else {
            once_revslider11 = true;
            revinit_revslider11();
        }
    </script>
    </body>
</html>
