<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        @if (isset($logo))
            {{ $logo }}
        @else
            <a href="/">
                <img src="\img\hdcevents_logo.svg" alt="Logo da Empresa" style="height:120px;">
            </a>
        @endif
    </div>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden">
        {{ $slot }}
    </div>
</div>
