<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Styles -->
    <style>
        /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */
        *,
        ::after,
        ::before {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e5e7eb
        }

        ::after,
        ::before {
            --tw-content: ''
        }

        html {
            line-height: 1.5;
            -webkit-text-size-adjust: 100%;
            -moz-tab-size: 4;
            tab-size: 4;
            font-family: Figtree, sans-serif;
            font-feature-settings: normal
        }

        body {
            margin: 0;
            line-height: inherit
        }

        hr {
            height: 0;
            color: inherit;
            border-top-width: 1px
        }

        abbr:where([title]) {
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: inherit;
            font-weight: inherit
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        b,
        strong {
            font-weight: bolder
        }

        code,
        kbd,
        pre,
        samp {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: 1em
        }

        small {
            font-size: 80%
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline
        }

        sub {
            bottom: -.25em
        }

        sup {
            top: -.5em
        }

        table {
            text-indent: 0;
            border-color: inherit;
            border-collapse: collapse
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: inherit;
            font-size: 100%;
            font-weight: inherit;
            line-height: inherit;
            color: inherit;
            margin: 0;
            padding: 0
        }

        button,
        select {
            text-transform: none
        }

        [type=button],
        [type=reset],
        [type=submit],
        button {
            -webkit-appearance: button;
            background-color: transparent;
            background-image: none
        }

        :-moz-focusring {
            outline: auto
        }

        :-moz-ui-invalid {
            box-shadow: none
        }

        progress {
            vertical-align: baseline
        }

        ::-webkit-inner-spin-button,
        ::-webkit-outer-spin-button {
            height: auto
        }

        [type=search] {
            -webkit-appearance: textfield;
            outline-offset: -2px
        }

        ::-webkit-search-decoration {
            -webkit-appearance: none
        }

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            font: inherit
        }

        summary {
            display: list-item
        }

        blockquote,
        dd,
        dl,
        figure,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        hr,
        p,
        pre {
            margin: 0
        }

        fieldset {
            margin: 0;
            padding: 0
        }

        legend {
            padding: 0
        }

        menu,
        ol,
        ul {
            list-style: none;
            margin: 0;
            padding: 0
        }

        textarea {
            resize: vertical
        }

        input::placeholder,
        textarea::placeholder {
            opacity: 1;
            color: #9ca3af
        }

        [role=button],
        button {
            cursor: pointer
        }

        :disabled {
            cursor: default
        }

        audio,
        canvas,
        embed,
        iframe,
        img,
        object,
        svg,
        video {
            display: block;
            vertical-align: middle
        }

        img,
        video {
            max-width: 100%;
            height: auto
        }

        [hidden] {
            display: none
        }

        *,
        ::before,
        ::after {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        ::-webkit-backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        ::backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        .relative {
            position: relative
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .mx-6 {
            margin-left: 1.5rem;
            margin-right: 1.5rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-16 {
            margin-top: 4rem
        }

        .mt-6 {
            margin-top: 1.5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .mr-1 {
            margin-right: 0.25rem
        }

        .flex {
            display: flex
        }

        .inline-flex {
            display: inline-flex
        }

        .grid {
            display: grid
        }

        .h-16 {
            height: 4rem
        }

        .h-7 {
            height: 1.75rem
        }

        .h-6 {
            height: 1.5rem
        }

        .h-5 {
            height: 1.25rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .w-auto {
            width: auto
        }

        .w-16 {
            width: 4rem
        }

        .w-7 {
            width: 1.75rem
        }

        .w-6 {
            width: 1.5rem
        }

        .w-5 {
            width: 1.25rem
        }

        .max-w-7xl {
            max-width: 80rem
        }

        .shrink-0 {
            flex-shrink: 0
        }

        .scale-100 {
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .gap-6 {
            gap: 1.5rem
        }

        .gap-4 {
            gap: 1rem
        }

        .self-center {
            align-self: center
        }

        .rounded-lg {
            border-radius: 0.5rem
        }

        .rounded-full {
            border-radius: 9999px
        }

        .bg-gray-100 {
            --tw-bg-opacity: 1;
            background-color: rgb(243 244 246 / var(--tw-bg-opacity))
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity))
        }

        .bg-red-50 {
            --tw-bg-opacity: 1;
            background-color: rgb(254 242 242 / var(--tw-bg-opacity))
        }

        .bg-dots-darker {
            background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")
        }

        .from-gray-700\/50 {
            --tw-gradient-from: rgb(55 65 81 / 0.5);
            --tw-gradient-to: rgb(55 65 81 / 0);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
        }

        .via-transparent {
            --tw-gradient-to: rgb(0 0 0 / 0);
            --tw-gradient-stops: var(--tw-gradient-from), transparent, var(--tw-gradient-to)
        }

        .bg-center {
            background-position: center
        }

        .stroke-red-500 {
            stroke: #ef4444
        }

        .stroke-gray-400 {
            stroke: #9ca3af
        }

        .p-6 {
            padding: 1.5rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .text-center {
            text-align: center
        }

        .text-right {
            text-align: right
        }

        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem
        }

        .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem
        }

        .font-semibold {
            font-weight: 600
        }

        .leading-relaxed {
            line-height: 1.625
        }

        .text-gray-600 {
            --tw-text-opacity: 1;
            color: rgb(75 85 99 / var(--tw-text-opacity))
        }

        .text-gray-900 {
            --tw-text-opacity: 1;
            color: rgb(17 24 39 / var(--tw-text-opacity))
        }

        .text-gray-500 {
            --tw-text-opacity: 1;
            color: rgb(107 114 128 / var(--tw-text-opacity))
        }

        .underline {
            -webkit-text-decoration-line: underline;
            text-decoration-line: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .shadow-2xl {
            --tw-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            --tw-shadow-colored: 0 25px 50px -12px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
        }

        .shadow-gray-500\/20 {
            --tw-shadow-color: rgb(107 114 128 / 0.2);
            --tw-shadow: var(--tw-shadow-colored)
        }

        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms
        }

        .selection\:bg-red-500 *::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(239 68 68 / var(--tw-bg-opacity))
        }

        .selection\:text-white *::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .selection\:bg-red-500::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(239 68 68 / var(--tw-bg-opacity))
        }

        .selection\:text-white::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .hover\:text-gray-900:hover {
            --tw-text-opacity: 1;
            color: rgb(17 24 39 / var(--tw-text-opacity))
        }

        .hover\:text-gray-700:hover {
            --tw-text-opacity: 1;
            color: rgb(55 65 81 / var(--tw-text-opacity))
        }

        .focus\:rounded-sm:focus {
            border-radius: 0.125rem
        }

        .focus\:outline:focus {
            outline-style: solid
        }

        .focus\:outline-2:focus {
            outline-width: 2px
        }

        .focus\:outline-red-500:focus {
            outline-color: #ef4444
        }

        .group:hover .group-hover\:stroke-gray-600 {
            stroke: #4b5563
        }

        .z-10 {
            z-index: 10
        }

        @media (prefers-reduced-motion: no-preference) {
            .motion-safe\:hover\:scale-\[1\.01\]:hover {
                --tw-scale-x: 1.01;
                --tw-scale-y: 1.01;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
            }
        }

        @media (prefers-color-scheme: dark) {
            .dark\:bg-gray-900 {
                --tw-bg-opacity: 1;
                background-color: rgb(17 24 39 / var(--tw-bg-opacity))
            }

            .dark\:bg-gray-800\/50 {
                background-color: rgb(31 41 55 / 0.5)
            }

            .dark\:bg-red-800\/20 {
                background-color: rgb(153 27 27 / 0.2)
            }

            .dark\:bg-dots-lighter {
                background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")
            }

            .dark\:bg-gradient-to-bl {
                background-image: linear-gradient(to bottom left, var(--tw-gradient-stops))
            }

            .dark\:stroke-gray-600 {
                stroke: #4b5563
            }

            .dark\:text-gray-400 {
                --tw-text-opacity: 1;
                color: rgb(156 163 175 / var(--tw-text-opacity))
            }

            .dark\:text-white {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .dark\:shadow-none {
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
            }

            .dark\:ring-1 {
                --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
                --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
                box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
            }

            .dark\:ring-inset {
                --tw-ring-inset: inset
            }

            .dark\:ring-white\/5 {
                --tw-ring-color: rgb(255 255 255 / 0.05)
            }

            .dark\:hover\:text-white:hover {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .group:hover .dark\:group-hover\:stroke-gray-400 {
                stroke: #9ca3af
            }
        }

        @media (min-width: 640px) {
            .sm\:fixed {
                position: fixed
            }

            .sm\:top-0 {
                top: 0px
            }

            .sm\:right-0 {
                right: 0px
            }

            .sm\:ml-0 {
                margin-left: 0px
            }

            .sm\:flex {
                display: flex
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-center {
                justify-content: center
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width: 768px) {
            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width: 1024px) {
            .lg\:gap-8 {
                gap: 2rem
            }

            .lg\:p-8 {
                padding: 2rem
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="antialiased">
    <div class="relative ">
        <div class="">
            @if (Route::has('login'))
                <div class="z-10 p-6 text-right sm:fixed sm:top-0 sm:right-0">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                            in</a>

                        {{-- @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif --}}
                    @endauth
                </div>
            @endif
        </div>
        <div class="mt-20 bg-gray-200">
            <div class="flex p-4 space-x-4 h-[500px] w-full">

                <div class="w-1/4 h-full p-2 bg-white rounded-lg join-item">
                    <div class="w-full h-full">
                        <div id="erAdmittedCount"></div>
                    </div>
                </div>
                <div class="w-2/4 h-full bg-white rounded-lg">
                    {{-- <h3 class="justify-center p-2 text-3xl font-bold">ICU'S</h3> --}}
                    <div class="grid w-full h-full grid-cols-5 grid-rows-2 gap-2 p-2">
                        <div id="ward2FICU"></div>
                        <div id="ward3FMIC"></div>
                        <div id="ward3FMN"></div>
                        <div id="ward3FMP"></div>
                        <div id="ward3FNIC"></div>
                        <div id="wardCBNS"></div>
                        <div id="wardCBPA"></div>
                        <div id="wardCBPN"></div>
                        <div id="wardSDICU"></div>
                        <div id="wardSICU"></div>
                    </div>
                </div>
                <div class="flex flex-col w-1/4 h-full bg-gray-200">
                    @php
                        $beds = App\Models\Bed::paginate(8, ['*'], 'bed_list');
                    @endphp
                    <div class="grid grid-cols-2 grid-rows-1 gap-2">
                        {{-- @if ($beds)
                            @foreach ($beds as $bed)
                                <div class="h-24 p-1 bg-white rounded-lg shadow-lg hover:bg-gray-50">
                                    <div class="flex items-center mt-0">
                                        <img src="{{ URL('/images/bed III.png') }}" class="w-[30px] h-[30px]">
                                        <div class="mt-3 ml-2 text-[12px] text-black underline uppercase">
                                            {{ $bed->bed_name }}
                                        </div>
                                    </div> <!-- for bed info and bed image-->
                                    <div>
                                        @foreach ($bed->patientBed as $patient)
                                            @if ($patient->patientHerlog)
                                                <div class="flex w-full gap-1 mt-2">
                                                    <div>
                                                        @if ($patient->patientHerlog->patientInfo->patsex == 'M')
                                                            <img src="{{ URL('/images/man III.PNG') }}"
                                                                class="w-[30px] h-[30px]">
                                                        @endif
                                                        @if ($patient->patientHerlog->patientInfo->patsex == 'F')
                                                            <img src="{{ URL('/images/women II.PNG') }}"
                                                                class="w-[30px] h-[30px]">
                                                        @endif
                                                    </div>
                                                    <div class="mt-0 ml-0 text-[12px] text-black ">
                                                        {{ $patient->patientHerlog->patientInfo->get_patient_name() }}
                                                        {{-- {{ $patient->patientHerlog->enccode }}
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div> <!-- bed div container--->
                            @endforeach
                        @endif
                    </div>
                    <div class="mt-2">
                        @if ($beds)
                            {{ $beds->links() }}
                        @endif
                    </div> --}}
                    </div>
                </div>
                <div>
                    @php
                        $erAdmittedCount = 0;
                        $erlogs = App\Models\PatientBed::select('enccode', 'patient_id')->get();
                        foreach ($erlogs as $logcount) {
                            if ($logcount->patientErLog) {
                                $erAdmittedCount++;
                                //dd('here');
                            }
                        }
                        if ($erAdmittedCount) {
                            $erslot = 50;
                            $erSlotAvailable = $erslot - $erAdmittedCount;
                        } else {
                            $erslot = 50;
                            $erSlotAvailable = $erslot - $erAdmittedCount;
                        }
                        //----
                        $ward2FICU = App\Models\HospitalHpatroom::with('admittedLogs')
                            ->select('enccode', 'patrmstat', 'wardcode')
                            ->where('wardcode', '2FICU')
                            ->where('patrmstat', 'A')
                            ->count();
                        if ($ward2FICU) {
                            $ward2FICUSlot = 25;
                            $ward2FICUAvailable = $ward2FICUSlot - $ward2FICU;
                        } else {
                            $ward2FICUSlot = 25;
                            $ward2FICUAvailable = $ward2FICUSlot - $ward2FICU;
                        }
                        //--ward2FICU
                        $ward3FMIC = App\Models\HospitalHpatroom::with('admittedLogs')
                            ->select('enccode', 'patrmstat', 'wardcode')
                            ->where('wardcode', '3FMIC')
                            ->where('patrmstat', 'A')
                            ->count();
                        if ($ward3FMIC) {
                            $ward3FMICSlot = 25;
                            $ward3FMICAvailable = $ward3FMICSlot - $ward3FMIC;
                        } else {
                            $ward3FMICSlot = 25;
                            $ward3FMICAvailable = $ward3FMICSlot - $ward3FMIC;
                        }
                        //----
                        $ward3FMN = App\Models\HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')
                            ->where('wardcode', '3FMN')
                            ->where('patrmstat', 'A')
                            ->with('admittedLogs')
                            ->count();
                        if ($ward3FMN) {
                            $ward3FMNSlot = 25;
                            $ward3FMNAvailable = $ward3FMNSlot - $ward3FMN;
                        } else {
                            $ward3FMNSlot = 25;
                            $ward3FMNAvailable = $ward3FMNSlot - $ward3FMN;
                        }
                        //----
                        $ward3FMP = App\Models\HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')
                            ->where('wardcode', '3FMP')
                            ->where('patrmstat', 'A')
                            ->with('admittedLogs')
                            ->count();
                        if ($ward3FMP) {
                            $ward3FMPSlot = 25;
                            $ward3FMPAvailable = $ward3FMPSlot - $ward3FMP;
                        } else {
                            $ward3FMPSlot = 25;
                            $ward3FMPAvailable = $ward3FMPSlot - $ward3FMP;
                        }
                        //----
                        $ward3FNIC = App\Models\HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')
                            ->where('wardcode', '3FNIC')
                            ->where('patrmstat', 'A')
                            ->with('admittedLogs')
                            ->count();
                        if ($ward3FNIC) {
                            $ward3FNICSlot = 25;
                            $ward3FNICAvailable = $ward3FNICSlot - $ward3FNIC;
                        } else {
                            $ward33FNICSlot = 25;
                            $ward3FNICAvailable = $ward33FNICSlot - $ward3FNIC;
                        }
                        //----
                        $wardCBNS = App\Models\HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')
                            ->where('wardcode', 'CBNS')
                            ->where('patrmstat', 'A')
                            ->with('admittedLogs')
                            ->count();
                        if ($wardCBNS) {
                            $wardCBNSSlot = 25;
                            $wardCBNSAvailable = $wardCBNSSlot - $wardCBNS;
                        } else {
                            $ward3CBNSSlot = 25;
                            $wardCBNSAvailable = $ward3CBNSSlot - $wardCBNS;
                        }
                        //----
                        $wardCBPA = App\Models\HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')
                            ->where('wardcode', 'CBPA')
                            ->where('patrmstat', 'A')
                            ->with('admittedLogs')
                            ->count();
                        if ($wardCBPA) {
                            $wardCBPASlot = 25;
                            $wardCBPAAvailable = $wardCBPASlot - $wardCBPA;
                        } else {
                            $ward3CBPASlot = 25;
                            $wardCBPAAvailable = $ward3CBPASlot - $wardCBPA;
                        }
                        //----
                        $wardCBPN = App\Models\HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')
                            ->where('wardcode', 'CBPN')
                            ->where('patrmstat', 'A')
                            ->with('admittedLogs')
                            ->count();
                        if ($wardCBPN) {
                            $wardCBPNSlot = 25;
                            $wardCBPNAvailable = $wardCBPNSlot - $wardCBPN;
                        } else {
                            $ward3CBPNSlot = 25;
                            $wardCBPNAvailable = $ward3CBPNSlot - $wardCBPN;
                        }
                        //----
                        $wardSDICU = App\Models\HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')
                            ->where('wardcode', 'SDICU')
                            ->where('patrmstat', 'A')
                            ->with('admittedLogs')
                            ->count();
                        if ($wardSDICU) {
                            $wardSDICUSlot = 25;
                            $wardSDICUAvailable = $wardSDICUSlot - $wardSDICU;
                        } else {
                            $ward3SDICUSlot = 25;
                            $wardSDICUAvailable = $ward3SDICUSlot - $wardSDICU;
                        }
                        //----
                        $wardSICU = App\Models\HospitalHpatroom::select('enccode', 'patrmstat', 'wardcode')
                            ->where('wardcode', 'SICU')
                            ->where('patrmstat', 'A')
                            ->with('admittedLogs')
                            ->count();
                        if ($wardSICU) {
                            $wardSICUSlot = 25;
                            $wardSICUAvailable = $wardSICUSlot - $wardSICU;
                        } else {
                            $ward3SICUSlot = 25;
                            $wardSICUAvailable = $ward3SICUSlot - $wardSICU;
                        }
                    @endphp
                </div>

            </div>

            <script>
                var ward2FICU = {
                    series: [@json($ward2FICU), @json($ward2FICUAvailable)],
                    chart: {
                        //height: 480,
                        height: 270,
                        type: 'donut',
                    },
                    plotOptions: {
                        pie: {
                            //size: 480,
                            donut: {
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        fontSize: 20,
                                        fontFamily: 'sans',
                                        // color: '#089629',
                                    }
                                }
                            }
                        }
                    },
                    labels: ['Ocuppied', 'Available', ],
                    legend: {
                        position: 'bottom',
                        fontSize: '12px',
                        fontWeight: 600,
                        fontFamily: 'sans',
                    },
                    title: {
                        text: '*SICU',
                        align: 'center',
                        style: {
                            fontSize: '12px',
                            fontWeight: 'bold',
                            fontFamily: 'sans',
                            // color: '#263238'
                        },
                    },
                    dataLabels: {
                        //enabled: true
                        formatter: (val, {
                            seriesIndex,
                            w
                        }) => w.config.series[seriesIndex]
                    },
                    colors: ["#03a155", "#2a4bf5"],
                    responsive: [{
                        breakpoint: 230,
                        options: {
                            chart: {
                                width: 200
                            },
                        }
                    }]
                };

                var chartward2FICU = new ApexCharts(document.querySelector("#ward2FICU"), ward2FICU);
                chartward2FICU.render();
                //--- ward2FICU
                var ward3FMIC = {
                    series: [@json($ward3FMIC), @json($ward3FMICAvailable)],
                    chart: {
                        //height: 480,
                        height: 270,
                        type: 'donut',
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        fontSize: 20,
                                        fontFamily: 'sans',
                                        // color: '#263238'
                                    }
                                }
                            }
                        }
                    },
                    labels: ['Ocuppied', 'Available', ],
                    legend: {
                        position: 'bottom',
                        fontSize: '12px',
                        fontWeight: 600,
                        fontFamily: 'sans',
                    },
                    title: {
                        text: 'OPD 3rd Floor (MICU B)',
                        align: 'center',
                        style: {
                            fontSize: '12px',
                            fontWeight: 'bold',
                            fontFamily: 'sans',
                            // color: '#263238'
                        },
                    },
                    dataLabels: {
                        // enabled: true
                        formatter: (val, {
                            seriesIndex,
                            w
                        }) => w.config.series[seriesIndex]
                    },
                    colors: ["#03a155", "#2a4bf5"],
                    responsive: [{
                        breakpoint: 230,
                        options: {
                            chart: {
                                width: 200
                            },
                        }
                    }]
                };

                var chartward3FMIC = new ApexCharts(document.querySelector("#ward3FMIC"), ward3FMIC);
                chartward3FMIC.render();
                //---ward3FMIC

                var ward3FMN = {
                    series: [@json($ward3FMN), @json($ward3FMNAvailable)],
                    chart: {
                        //height: 480,
                        height: 270,
                        type: 'donut',
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        fontSize: 20,
                                        fontFamily: 'sans',
                                        // color: '#263238'
                                    }
                                }
                            }
                        }
                    },
                    labels: ['Ocuppied', 'Available', ],
                    legend: {
                        position: 'bottom',
                        fontSize: '12px',
                        fontWeight: 600,
                        fontFamily: 'sans',
                    },
                    title: {
                        text: 'Main 3rd Floor  (NICU A)',
                        align: 'center',
                        style: {
                            fontSize: '12px',
                            fontWeight: 'bold',
                            fontFamily: 'sans',
                            // color: '#263238'
                        },
                    },
                    dataLabels: {
                        // enabled: true
                        formatter: (val, {
                            seriesIndex,
                            w
                        }) => w.config.series[seriesIndex]
                    },
                    colors: ["#03a155", "#2a4bf5"],
                    responsive: [{
                        breakpoint: 230,
                        options: {
                            chart: {
                                width: 200
                            },
                        }
                    }]
                };

                var chartward3FMN = new ApexCharts(document.querySelector("#ward3FMN"), ward3FMN);
                chartward3FMN.render();
                //---ward3FMN

                var ward3FMP = {
                    series: [@json($ward3FMP), @json($ward3FMPAvailable)],
                    chart: {
                        //height: 480,
                        height: 270,
                        type: 'donut',
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        fontSize: 20,
                                        fontFamily: 'sans',
                                        // color: '#263238'
                                    }
                                }
                            }
                        }
                    },
                    labels: ['Ocuppied', 'Available', ],
                    legend: {
                        position: 'bottom',
                        fontSize: '12px',
                        fontWeight: 600,
                        fontFamily: 'sans',
                    },
                    title: {
                        text: 'OPD 3rd Floor (MICU A)',
                        align: 'center',
                        style: {
                            fontSize: '12px',
                            fontWeight: 'bold',
                            fontFamily: 'sans',
                            // color: '#263238'
                        },
                    },
                    dataLabels: {
                        // enabled: true
                        formatter: (val, {
                            seriesIndex,
                            w
                        }) => w.config.series[seriesIndex]
                    },
                    colors: ["#03a155", "#2a4bf5"],
                    responsive: [{
                        breakpoint: 230,
                        options: {
                            chart: {
                                width: 200
                            },
                        }
                    }]
                };

                var chartward3FMP = new ApexCharts(document.querySelector("#ward3FMP"), ward3FMP);
                chartward3FMP.render();
                //---ward3FMP

                var ward3FNIC = {
                    series: [@json($ward3FNIC), @json($ward3FNICAvailable)],
                    chart: {
                        //height: 480,
                        height: 270,
                        type: 'donut',
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        fontSize: 20,
                                        fontFamily: 'sans',
                                        // color: '#263238'
                                    }
                                }
                            }
                        }
                    },
                    labels: ['Ocuppied', 'Available', ],
                    legend: {
                        position: 'bottom',
                        fontSize: '12px',
                        fontWeight: 600,
                        fontFamily: 'sans',
                    },
                    title: {
                        text: '3rd Floor(NICU)*',
                        align: 'center',
                        style: {
                            fontSize: '12px',
                            fontWeight: 'bold',
                            fontFamily: 'sans',
                            // color: '#263238'
                        },
                    },
                    dataLabels: {
                        // enabled: true
                        formatter: (val, {
                            seriesIndex,
                            w
                        }) => w.config.series[seriesIndex]
                    },
                    colors: ["#03a155", "#2a4bf5"],
                    responsive: [{
                        breakpoint: 230,
                        options: {
                            chart: {
                                width: 200
                            },
                        }
                    }]
                };

                var chartward3FNIC = new ApexCharts(document.querySelector("#ward3FNIC"), ward3FNIC);
                chartward3FNIC.render();
                //---ward3FMP

                var wardCBNS = {
                    series: [@json($wardCBNS), @json($wardCBNSAvailable)],
                    chart: {
                        //height: 480,
                        height: 270,
                        type: 'donut',
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        fontSize: 20,
                                        //fontWeight: 'bold',
                                        fontFamily: 'sans',
                                    }
                                }
                            }
                        }
                    },
                    labels: ['Ocuppied', 'Available', ],
                    legend: {
                        position: 'bottom',
                        fontSize: '12px',
                        fontWeight: 600,
                        fontFamily: 'sans',
                    },
                    title: {
                        text: 'Main 3rd Floor (NICU B)',
                        align: 'center',
                        style: {
                            fontSize: '12px',
                            fontWeight: 'bold',
                            fontFamily: 'sans',
                            // color: '#263238'
                        },
                    },
                    dataLabels: {
                        // enabled: true
                        formatter: (val, {
                            seriesIndex,
                            w
                        }) => w.config.series[seriesIndex]
                    },
                    colors: ["#03a155", "#2a4bf5"],
                    responsive: [{
                        breakpoint: 230,
                        options: {
                            chart: {
                                width: 200
                            },
                        }
                    }]
                };

                var chartwardCBNS = new ApexCharts(document.querySelector("#wardCBNS"), wardCBNS);
                chartwardCBNS.render();
                //---wardCBNS

                var wardCBPA = {
                    series: [@json($wardCBPA), @json($wardCBPAAvailable)],
                    chart: {
                        //height: 480,
                        height: 270,
                        type: 'donut',
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        fontSize: 20,
                                        //fontWeight: 'bold',
                                        fontFamily: 'sans',
                                    }
                                }
                            }
                        }
                    },
                    labels: ['Ocuppied', 'Available', ],
                    legend: {
                        position: 'bottom',
                        fontSize: '12px',
                        fontWeight: 600,
                        fontFamily: 'sans',
                    },
                    title: {
                        text: 'Annex 2nd Floor (Pedia A & PICU A)',
                        align: 'center',
                        style: {
                            fontSize: '12px',
                            fontWeight: 'bold',
                            fontFamily: 'sans',
                            // color: '#263238'
                        },
                    },
                    dataLabels: {
                        // enabled: true
                        formatter: (val, {
                            seriesIndex,
                            w
                        }) => w.config.series[seriesIndex]
                    },
                    colors: ["#03a155", "#2a4bf5"],
                    responsive: [{
                        breakpoint: 230,
                        options: {
                            chart: {
                                width: 200
                            },
                        }
                    }]
                };

                var chartwardCBPA = new ApexCharts(document.querySelector("#wardCBPA"), wardCBPA);
                chartwardCBPA.render();
                //---wardCBPA

                var wardCBPN = {
                    series: [@json($wardCBPN), @json($wardCBPNAvailable)],
                    chart: {
                        //height: 480,
                        height: 270,
                        type: 'donut',
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        fontSize: 20,
                                        //fontWeight: 'bold',
                                        fontFamily: 'sans',
                                    }
                                }
                            }
                        }
                    },
                    labels: ['Ocuppied', 'Available', ],
                    legend: {
                        position: 'bottom',
                        fontSize: '12px',
                        fontWeight: 600,
                        fontFamily: 'sans',
                    },
                    title: {
                        text: 'Annex 2nd Floor (PICU B)',
                        align: 'center',
                        style: {
                            fontSize: '12px',
                            fontWeight: 'bold',
                            fontFamily: 'sans',
                            // color: '#263238'
                        },
                    },
                    dataLabels: {
                        // enabled: true
                        formatter: (val, {
                            seriesIndex,
                            w
                        }) => w.config.series[seriesIndex]
                    },
                    colors: ["#03a155", "#2a4bf5"],
                    responsive: [{
                        breakpoint: 230,
                        options: {
                            chart: {
                                width: 200
                            },
                        }
                    }]
                };

                var chartwardCBPN = new ApexCharts(document.querySelector("#wardCBPN"), wardCBPN);
                chartwardCBPN.render();
                //---wardCBPN

                var wardSDICU = {
                    series: [@json($wardSDICU), @json($wardSDICUAvailable)],
                    chart: {
                        //height: 480,
                        height: 270,
                        type: 'donut',
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        fontSize: 20,
                                        //fontWeight: 'bold',
                                        fontFamily: 'sans',
                                    }
                                }
                            }
                        }
                    },
                    labels: ['Ocuppied', 'Available', ],
                    legend: {
                        position: 'bottom',
                        fontSize: '12px',
                        fontWeight: 600,
                        fontFamily: 'sans',
                    },
                    title: {
                        text: 'Stepdown',
                        align: 'center',
                        style: {
                            fontSize: '12px',
                            fontWeight: 'bold',
                            fontFamily: 'sans',
                            // color: '#263238'
                        },
                    },
                    dataLabels: {
                        // enabled: true
                        formatter: (val, {
                            seriesIndex,
                            w
                        }) => w.config.series[seriesIndex]
                    },
                    colors: ["#03a155", "#2a4bf5"],
                    responsive: [{
                        breakpoint: 230,
                        options: {
                            chart: {
                                width: 200
                            },
                        }
                    }]
                };

                var chartwardSDICU = new ApexCharts(document.querySelector("#wardSDICU"), wardSDICU);
                chartwardSDICU.render();
                //---wardSDICU

                var wardSICU = {
                    series: [@json($wardSICU), @json($wardSICUAvailable)],
                    chart: {
                        //height: 480,
                        height: 270,
                        type: 'donut',
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        fontSize: 20,
                                        //fontWeight: 'bold',
                                        fontFamily: 'sans',
                                    }
                                }
                            }
                        }
                    },
                    labels: ['Ocuppied', 'Available', ],
                    legend: {
                        position: 'bottom',
                        fontSize: '12px',
                        fontWeight: 600,
                        fontFamily: 'sans',
                    },
                    title: {
                        text: 'SICU',
                        align: 'center',
                        style: {
                            fontSize: '12px',
                            fontWeight: 'bold',
                            fontFamily: 'sans',
                            // color: '#263238'
                        },
                    },
                    dataLabels: {
                        // enabled: true
                        formatter: (val, {
                            seriesIndex,
                            w
                        }) => w.config.series[seriesIndex]
                    },
                    colors: ["#03a155", "#2a4bf5"],
                    responsive: [{
                        breakpoint: 230,
                        options: {
                            chart: {
                                width: 200
                            },
                        }
                    }]
                };

                var chartwardSICU = new ApexCharts(document.querySelector("#wardSICU"), wardSICU);
                chartwardSICU.render();
                //---wardSICU

                var erAdmittedCount = {
                    series: [@json($erAdmittedCount), @json($erSlotAvailable)],
                    chart: {
                        height: 450,
                        //height: 270,
                        type: 'donut',
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                //background: '#030a91',
                                labels: {
                                    show: true,
                                    color: '#FFFFFF',
                                    total: {
                                        show: true,
                                        fontSize: 20,
                                        fontFamily: 'fontFamily',
                                    }
                                }
                            }
                        }
                    },
                    labels: ['Ocuppied', 'Available', ],
                    legend: {
                        position: 'bottom',
                        fontSize: '12px',
                        fontWeight: 600,
                        fontFamily: 'sans',
                    },
                    title: {
                        text: 'ER',
                        align: 'center',
                        style: {
                            fontSize: '12px',
                            fontWeight: 'bold',
                            fontFamily: 'sans',
                            // color: '#263238'
                        },
                    },
                    dataLabels: {
                        // enabled: true
                        formatter: (val, {
                            seriesIndex,
                            w
                        }) => w.config.series[seriesIndex]
                    },
                    colors: ["#03a155", "#2a4bf5"],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                        }
                    }]
                };

                var charterAdmittedCount = new ApexCharts(document.querySelector("#erAdmittedCount"), erAdmittedCount);
                charterAdmittedCount.render();
                //---erAdmittedCount
            </script>
        </div>



</body>

</html>
