<x-dynamic-component
        :component="$getFieldWrapperView()"
        :id="$getId()"
        :label="$getLabel()"
        :label-sr-only="$isLabelHidden()"
        :helper-text="$getHelperText()"
        :hint="$getHint()"
        :required="$isRequired()"
        :state-path="$getStatePath()"
>
    @php
        $grapesJsOptions = $getGrapesJsOptions();
    @endphp
    <div
        class="filament-grapesjs"
    >
        <script>
            window.grapesJsOptions = @json($grapesJsOptions);
        </script>

        <x-filament::button data-open-editor="">
            Open Editor
        </x-filament::button>

        <div class="editor-container editor-hidden" data-editor-container="">
            <div id="gjs" class="editor-canvas" style="height:0px; overflow:hidden"></div>
        </div>
    </div>
</x-dynamic-component>
