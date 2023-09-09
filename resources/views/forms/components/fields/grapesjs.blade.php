<x-dynamic-component
        :component="$getFieldWrapperView()"
        :field="$field"
>
    <div
        x-ignore
        ax-load
        ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('filament-grapesjs-component') }}"
        x-data="filamentGrapesJsComponent({
                    state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$statePath}')") }},
                    statePath: '{{ $getStatePath() }}',
                    readOnly: {{ $isDisabled() ? 'true' : 'false' }},
                    options: @js($getGrapesJsOptions()),
                })"
        class="filament-grapesjs"
    >
        <style>
            :root{
                /*
                    TODO: Finish color options
                */
                --grapesJsEditorColor: #212121;
                --grapesJsTextColor: #818181;
                --grapesJsTextActiveColor: #ffffff;
                --grapesJsPageBgColor: #ffffff;
            }
        </style>

        <x-filament::button @click="openEditor">
            Open Editor
        </x-filament::button>

        <div class="editor-container" x-show="open">
            <div id="gjs" class="editor-canvas" style="height:0px; overflow:hidden"></div>
        </div>

    </div>
</x-dynamic-component>
