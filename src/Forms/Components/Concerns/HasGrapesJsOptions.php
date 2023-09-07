<?php

namespace Ekremogul\FilamentGrapesjs\Forms\Components\Concerns;

use Ekremogul\FilamentGrapesjs\Models\GrapesJsBlock;
use Nette\NotImplementedException;

trait HasGrapesJsOptions
{
    private array $customBlocks = [];

    private array $customComponents = [];

    private bool $autoSave = false;
    private int $stepsBeforeSave = 1;
    private bool $recovery = false;

    private bool $storeHtml = true;
    private bool $storeInlineStyles = true;
    private bool $storeCss = true;
    private bool $deviceManagerBtnEnabled = true;
    private bool $viewComponentsBtnEnabled = true;
    private bool $previewBtnEnabled = true;
    private bool $viewCodeBtnEnabled = true;
    private bool $fullscreenBtnEnabled = true;
    private bool $undoBtnEnabled = true;
    private bool $redoBtnEnabled = true;
    private bool $importBtnEnabled = true;
    private bool $clearCanvasBtnEnabled = true;

    /**
     * Add custom blocks to the editor.
     *
     * @param GrapesJsBlock[] $blocks
     * @return void
     */
    public function addBlocks(...$blocks): void
    {
        $this->customBlocks = array_merge($this->customBlocks, $blocks);
    }

    /**
     * Add custom components to the editor.
     *
     * @param array $components
     * @return void
     */
    public function addComponents(array $components): void
    {
        throw new NotImplementedException("This feature is not implemented yet.");
    }

    /**
     * Enable/disable autosaving.
     *
     * @return void
     */
    public function autoSave(): void
    {
        $this->autoSave = true;
    }

    /**
     * If autosave enabled, indicates how many steps (general changes to structure)
     * need to be done before save. Useful with remoteStorage to reduce remote calls
     *
     * @return int
     */
    public function getStepsBeforeSave(): int
    {
        return $this->stepsBeforeSave;
    }

    /**
     * If autosave enabled, indicates how many steps (general changes to structure)
     * need to be done before save. Useful with remoteStorage to reduce remote calls
     *
     * @param int $steps
     * @return void
     */
    public function stepsBeforeSave(int $steps): void
    {
        $this->stepsBeforeSave = $steps;
    }

    /**
     * In case the `remote` storage is selected, and this options is enabled, the project
     * will be stored on the `local` storage in case the remote one fails.
     *
     * @return void
     */
    public function recovery(): void
    {
        $this->recovery = true;
    }

    /**
     * Disable storing HTML.
     *
     * @return void
     */
    public function disableStoreHtml(): void
    {
        $this->storeHtml = false;
    }

    /**
     * Disable storing inline styles.
     *
     * @return void
     */
    public function disableStoreInlineStyles(): void
    {
        $this->storeInlineStyles = false;
    }

    /**
     * Disable storing CSS.
     *
     * @return void
     */
    public function disableStoreCss(): void
    {
        $this->storeCss = false;
    }

    /**
     * Disable the device manager button.
     *
     * @return void
     */
    public function disableDeviceManagerBtn(): void
    {
        $this->deviceManagerBtnEnabled = false;
    }

    /**
     * Disable the view components button.
     *
     * @return void
     */
    public function disableViewComponentsBtn(): void
    {
        $this->viewComponentsBtnEnabled = false;
    }

    /**
     * Disable the preview button.
     *
     * @return void
     */
    public function disablePreviewBtn(): void
    {
        $this->previewBtnEnabled = false;
    }

    /**
     * Disable the view code button.
     *
     * @return void
     */
    public function disableViewCodeBtn(): void
    {
        $this->viewCodeBtnEnabled = false;
    }

    /**
     * Disable the fullscreen button.
     *
     * @return void
     */
    public function disableFullscreenBtn(): void
    {
        $this->fullscreenBtnEnabled = false;
    }

    /**
     * Disable the undo button.
     *
     * @return void
     */
    public function disableUndoBtn(): void
    {
        $this->undoBtnEnabled = false;
    }

    /**
     * Disable the redo button.
     *
     * @return void
     */
    public function disableRedoBtn(): void
    {
        $this->redoBtnEnabled = false;
    }

    /**
     * Disable the import button.
     *
     * @return void
     */
    public function disableImportBtn(): void
    {
        $this->importBtnEnabled = false;
    }

    /**
     * Disable the clear canvas button.
     *
     * @return void
     */
    public function disableClearCanvasBtn(): void
    {
        $this->clearCanvasBtnEnabled = false;
    }

    /**
     * Get the custom blocks.
     *
     * @return GrapesJsBlock[]
     */
    public function getCustomBlocks(): array
    {
        return $this->customBlocks;
    }

    /**
     * Get the grapesjs options.
     *
     * @return array
     */
    public function getGrapesJsOptions(): array
    {
        return [
            "autoSave" => $this->autoSave,
            "stepsBeforeSave" => $this->stepsBeforeSave,
            "recovery" => $this->recovery,
            "storeHtml" => $this->storeHtml,
            "storeInlineStyles" => $this->storeInlineStyles,
            "storeCss" => $this->storeCss,
            "deviceManagerBtnEnabled" => $this->deviceManagerBtnEnabled,
            "viewComponentsBtnEnabled" => $this->viewComponentsBtnEnabled,
            "previewBtnEnabled" => $this->previewBtnEnabled,
            "viewCodeBtnEnabled" => $this->viewCodeBtnEnabled,
            "fullscreenBtnEnabled" => $this->fullscreenBtnEnabled,
            "undoBtnEnabled" => $this->undoBtnEnabled,
            "redoBtnEnabled" => $this->redoBtnEnabled,
            "importBtnEnabled" => $this->importBtnEnabled,
            "clearCanvasBtnEnabled" => $this->clearCanvasBtnEnabled,
            "customBlocks" => $this->customBlocks,
        ];
    }

}
