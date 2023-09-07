<?php

namespace Ekremogul\FilamentGrapesjs\Models;

class GrapesJsBlock
{

    private string|null $id;
    private string $label;
    private string $content;

    private string $media = "";
    private string $category = "";
    private bool $activate = false;
    private bool $select = false;
    private bool $resetId = false;
    private bool $disable = false;
    private string $onClickScript = "";
    /**
     * @var GrapesJsBlockAttribute[] $attributes
     */
    private array $attributes = [];

    /**
     * @param string $label Block label, eg. `My block`
     * @param string $content Block content, eg. `<div>My block</div>`
     */
    public function __construct(string $label, string $content)
    {
        $this->label = $label;
        $this->content = $content;
    }

    /**
     * @param string $id Block id, eg. `my-block`
     * @return void
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $media HTML string for the media/icon of the block, eg. `<svg ...`, `<img ...`, etc.
     * @return void
     */
    public function setMedia(string $media): void
    {
        $this->media = $media;
    }

    /**
     * @param string $category Block category, eg. `Basic blocks`
     * @return void
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * @param bool $activate If true, triggers the `active` event on the dropped component.
     * @return void
     */
    public function setActivate(bool $activate): void
    {
        $this->activate = $activate;
    }

    /**
     * @param bool $select If true, the dropped component will be selected.
     * @return void
     */
    public function setSelect(bool $select): void
    {
        $this->select = $select;
    }

    /**
     * @param bool $resetId If true, all IDs of dropped components and their styles will be changed.
     * @return void
     */
    public function setResetId(bool $resetId): void
    {
        $this->resetId = $resetId;
    }

    /**
     * @param bool $disable Disable the block from being interacted.
     * @return void
     */
    public function setDisable(bool $disable): void
    {
        $this->disable = $disable;
    }

    /**
     * @param string $onClickScript Custom behavior on click.
     * @return void
     * @example js: `(block, editor) => editor.getWrapper().append(block.get('content'))`
     */
    public function setOnClickScript(string $onClickScript): void
    {
        $this->onClickScript = $onClickScript;
    }

    /**
     * @param GrapesJsBlockAttribute $attribute Block attribute.
     * @return void
     */
    public function addAttribute(GrapesJsBlockAttribute $attribute): void
    {
        $this->attributes[] = $attribute;
    }

    /**
     * @param GrapesJsBlockAttribute[] $attributes Block attributes.
     * @return void
     */
    public function addAttributes(array $attributes): void
    {
        foreach ($attributes as $attribute) {
            $this->addAttribute($attribute);
        }
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getMedia(): string
    {
        return $this->media;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return bool
     */
    public function isActivate(): bool
    {
        return $this->activate;
    }

    /**
     * @return bool
     */
    public function isSelect(): bool
    {
        return $this->select;
    }

    /**
     * @return bool
     */
    public function isResetId(): bool
    {
        return $this->resetId;
    }

    /**
     * @return bool
     */
    public function isDisable(): bool
    {
        return $this->disable;
    }

    /**
     * @return string
     */
    public function getOnClickScript(): string
    {
        return $this->onClickScript;
    }

    /**
     * @return GrapesJsBlockAttribute[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

}
