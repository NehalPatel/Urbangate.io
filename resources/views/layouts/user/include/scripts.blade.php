    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#5d78ff",
                    "dark": "#282a3c",
                    "light": "#ffffff",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": [
                        "#c5cbe3",
                        "#a1a8c3",
                        "#3d4465",
                        "#3e4466"
                    ],
                    "shape": [
                        "#f0f3ff",
                        "#d9dffa",
                        "#afb4d4",
                        "#646c9a"
                    ]
                }
            }
        };
    </script>

    <!-- end::Global Config -->

    <!--begin::Global Theme Bundle(used by all pages) -->
    <script src="{{ config('panel.paths.assets') }}/plugins/global/plugins.bundle.js" type="text/javascript"></script>
    <script src="{{ config('panel.paths.assets') }}/js/scripts.bundle.js" type="text/javascript"></script>

    <!-- Util -->
    <script src="<?php echo asset('assets'); ?>/util/js/util.js" type="text/javascript"></script>
    <?php /**** ?>
    <script src="<?php echo asset('assets'); ?>/util/js/util-ui.js" type="text/javascript"></script>
    <script src="<?php echo asset('assets'); ?>/util/js/util-functions.js" type="text/javascript"></script>
    <script src="<?php echo asset('assets'); ?>/util/js/util-jquery.js" type="text/javascript"></script>
    <?php /****/ ?>
    <script src="<?php echo asset('assets'); ?>/util/js/util-globals.js" type="text/javascript"></script>
    <?php /**** ?>
    <script src="<?php echo asset('assets'); ?>/util/js/util-uploader.js" type="text/javascript"></script>
    <?php /****/ ?>


    <!--end::Global Theme Bundle -->
    <script src="{{ config('panel.paths.assets') }}/js/admin.js" type="text/javascript"></script>

    <!--end::Page Scripts -->