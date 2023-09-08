<?php

namespace Ekremogul\FilamentGrapesjs\Forms\Components;

use Ekremogul\FilamentGrapesjs\Forms\Components\Concerns\HasColors;
use Ekremogul\FilamentGrapesjs\Forms\Components\Concerns\HasGrapesJsOptions;
use Filament\Forms\Components\Field;
use Livewire\Attributes\On;

class GrapesJs extends Field
{
    use HasGrapesJsOptions;
    use HasColors;

    protected string $view = 'filament-grapesjs::forms.components.fields.grapesjs';

    protected string $editorData;
    protected string $htmlData;

    public function getEditorData()
    {
        return $this->evaluate($this->getState());
    }

    public function getHtmlData()
    {
        return $this->evaluate($this->getState());
    }

}
