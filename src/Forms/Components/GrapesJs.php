<?php

namespace Ekremogul\FilamentGrapesjs\Forms\Components;

use Ekremogul\FilamentGrapesjs\Forms\Components\Concerns\HasGrapesJsOptions;
use Ekremogul\FilamentGrapesjs\Forms\Components\Concerns\InteractsWithTools;
use Filament\Forms\Components\Field;
use Livewire\Attributes\On;

class GrapesJs extends Field
{
    use HasGrapesJsOptions;

    #[On('test')]
    public function test($data): void
    {
        file_put_contents('test.txt', json_encode($data));
    }

    protected string $view = 'filament-grapesjs::forms.components.fields.grapesjs';

    protected string $htmlData;

    public function getHtmlData()
    {
        return $this->evaluate($this->getState());
    }

}
