<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {!! theme()->printHtmlAttributes('html') !!} {{ theme()->printHtmlClasses('html') }}>
{{-- begin::Head --}}

<head>
    <meta charset="utf-8" />
    <title>{{ ucfirst(theme()->getOption('meta', 'title')) }} | an Online School Management App</title>
    <meta name="description" content="{{ ucfirst(theme()->getOption('meta', 'description')) }}" />
    <meta name="keywords" content="{{ theme()->getOption('meta', 'keywords') }}" />
    <link rel="canonical" href="{{ ucfirst(theme()->getOption('meta', 'canonical')) }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset(theme()->getDemo() . '/' .theme()->getOption('assets', 'favicon')) }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


    {{-- begin::Fonts --}}
    {{ theme()->includeFonts() }}
    {{-- end::Fonts --}}

    @if (theme()->hasOption('page', 'assets/vendors/css'))
    {{-- begin::Page Vendor Stylesheets(used by this page) --}}
    @foreach (array_unique(theme()->getOption('page', 'assets/vendors/css')) as $file)
    {!! preloadCss(assetCustom($file)) !!}
    @endforeach
    {{-- end::Page Vendor Stylesheets --}}
    @endif

    @if (theme()->hasOption('page', 'assets/custom/css'))
    {{-- begin::Page Custom Stylesheets(used by this page) --}}
    @foreach (array_unique(theme()->getOption('page', 'assets/custom/css')) as $file)
    {!! preloadCss(assetCustom($file)) !!}
    @endforeach
    {{-- end::Page Custom Stylesheets --}}
    @endif

    @if (theme()->hasOption('assets', 'css'))
    {{-- begin::Global Stylesheets Bundle(used by all pages) --}}
    @foreach (array_unique(theme()->getOption('assets', 'css')) as $file)
    @if (strpos($file, 'plugins') !== false)
    {!! preloadCss(assetCustom($file)) !!}
    @else
    <link href="{{ assetCustom($file) }}" rel="stylesheet" type="text/css" />
    @endif
    @endforeach
    {{-- end::Global Stylesheets Bundle --}}
    @endif

    @if (theme()->getViewMode() === 'preview')
    {{ theme()->getView('partials/trackers/_ga-general') }}
    {{ theme()->getView('partials/trackers/_ga-tag-manager-for-head') }}
    @endif

    @yield('styles')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #section-to-print,
            #section-to-print * {
                visibility: visible;
            }

            #section-to-print {
                left: 0;
                top: 0;
            }

            table {
                width: 100%;
            }

        }
    </style>
</head>
{{-- end::Head --}}

{{-- begin::Body --}}

<body {!! theme()->printHtmlAttributes('body') !!} {!! theme()->printHtmlClasses('body') !!} {!! theme()->printCssVariables('body') !!} data-kt-name="metronic">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <!--begin::Theme mode setup on page load-->
    <script>
        if (document.documentElement) {
            var name = document.body.getAttribute("data-kt-name");
            var themeMode = localStorage.getItem("kt_" + name + "_theme_mode_value");
            var enableSystemMode = true;

            if (themeMode) {
                if (themeMode === "dark") {
                    document.documentElement.setAttribute("data-theme", "dark");
                } else if (themeMode === "light") {
                    document.documentElement.setAttribute("data-theme", "light");
                } else if (enableSystemMode === true || themeMode === "system") {
                    document.documentElement.setAttribute("data-theme", window.matchMedia('(prefers-color-scheme: dark)') ? "dark" : "light");
                }
            } else {
                document.documentElement.setAttribute("data-theme", "light");
            }
        }
    </script>
    <!--end::Theme mode setup on page load-->

    @if (theme()->getOption('layout', 'loader/display') === true)
    {{ theme()->getView('layout/_loader') }}
    @endif

    @yield('content')

    {{-- begin::Javascript --}}
    @if (theme()->hasOption('assets', 'js'))
    {{-- begin::Global Javascript Bundle(used by all pages) --}}
    @foreach (array_unique(theme()->getOption('assets', 'js')) as $file)
    <script src="{{ asset(theme()->getDemo() . '/' .$file) }}"></script>
    @endforeach
    {{-- end::Global Javascript Bundle --}}
    @endif

    @if (theme()->hasOption('page', 'assets/vendors/js'))
    {{-- begin::Page Vendors Javascript(used by this page) --}}
    @foreach (array_unique(theme()->getOption('page', 'assets/vendors/js')) as $file)
    <script src="{{ asset(theme()->getDemo() . '/' .$file) }}"></script>
    @endforeach
    {{-- end::Page Vendors Javascript --}}
    @endif

    @if (theme()->hasOption('page', 'assets/custom/js'))
    {{-- begin::Page Custom Javascript(used by this page) --}}
    @foreach (array_unique(theme()->getOption('page', 'assets/custom/js')) as $file)
    <script src="{{ asset(theme()->getDemo() . '/' .$file) }}"></script>
    @endforeach
    {{-- end::Page Custom Javascript --}}
    @endif
    {{-- end::Javascript --}}

    @if (theme()->getViewMode() === 'preview')
    {{ theme()->getView('partials/trackers/_ga-tag-manager-for-body') }}
    @endif


    @yield('scripts')
    
</body>
{{-- end::Body --}}

</html>