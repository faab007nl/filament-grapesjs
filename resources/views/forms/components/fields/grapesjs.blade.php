<div
    x-data="grapesjs({
                state: $wire.entangle('{{ $getStatePath() }}').defer,
                statePath: '{{ $getStatePath() }}',
                readOnly: {{ $isDisabled() ? 'true' : 'false' }},
                optionsEncoded: '{{ base64_encode(json_encode($getGrapesJsOptions())) }}'
            })"
    class="filament-grapesjs"
>
{{--    <script>--}}
{{--        window.grapesJsOptions = @json($grapesJsOptions);--}}
{{--    </script>--}}

    <x-filament::button @click="openEditor">
        Open Editor
    </x-filament::button>

    <div class="editor-container" x-show="open">
        <div id="gjs" class="editor-canvas" style="height:0px; overflow:hidden"></div>
    </div>

</div>
