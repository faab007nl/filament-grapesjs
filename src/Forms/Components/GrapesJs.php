<?php

namespace Ekremogul\FilamentGrapesjs\Forms\Components;

use Closure;
use Ekremogul\FilamentGrapesjs\Forms\Components\Concerns\HasGrapesJsOptions;
use Ekremogul\FilamentGrapesjs\Forms\Components\Concerns\InteractsWithTools;
use Filament\Forms\Components\Field;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

class GrapesJs extends Field
{
    use InteractsWithTools;
    use HasGrapesJsOptions;

    protected string $view = 'filament-grapesjs::forms.components.fields.grapesjs';

    protected array | Closure $tools = [

    ];

    protected string $htmlData;

    protected int | Closure | null $minHeight = 768;

    public string $test = "test1235";

    public function minHeight(int | Closure | null $minHeight): static
    {
        $this->minHeight = $minHeight;

        return $this;
    }

    public function getMinHeight(): ?int
    {
        return $this->evaluate($this->minHeight);
    }

    public function getHtmlData()
    {
        return $this->evaluate($this->getState());
    }

}
