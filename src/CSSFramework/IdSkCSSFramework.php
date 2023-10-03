<?php

namespace TJBW\IdSkElemental\CSSFramework;

use DNADesign\Elemental\Models\BaseElement;
use WeDevelop\ElementalGrid\CSSFramework\CSSFrameworkInterface;
use WeDevelop\ElementalGrid\ElementalConfig;

if (!interface_exists(CSSFrameworkInterface::class)) {
    return;
}

final class IdSkCSSFramework implements CSSFrameworkInterface
{
    private BaseElement $baseElement;

    private const COLUMN_CLASSNAME = 'govuk-grid-column';

    private const ROW_CLASSNAME = 'govuk-grid-row govuk-grid-row--auto-spacing';

    public function __construct(BaseElement $baseElement)
    {
        $this->baseElement = $baseElement;
    }

    public function getRowClasses(): string
    {
        return self::ROW_CLASSNAME;
    }

    public function getColumnClass(): string
    {
        return self::COLUMN_CLASSNAME;
    }

    public function getColumnClasses(): string
    {
        return implode(' ', $this->getSizeClasses());
    }

    public function getDefaultTitleSize(): string
    {
        return 'h2';
    }

    public function getTitleSizeClass(): string
    {
        $titleSizeClasses = [
            'h1' => 'govuk-heading-xl',
            'h2' => 'govuk-heading-l',
            'h3' => 'govuk-heading-m',
            'h4' => 'govuk-heading-s',
        ];

        $titleSizeClass = $titleSizeClasses[$this->getDefaultTitleSize()];

        if (
            ElementalConfig::getEnableCustomTitleClasses()
            && $this->baseElement->config()->get('displays_title_class_field')
        ) {
            $titleSizeClass = $titleSizeClasses[$this->baseElement->TitleClass] ?? $titleSizeClass;
        }

        return $titleSizeClass;
    }

    public function getContainerClass(bool $fluid): string
    {
        return '';
    }

    public function getMediaRatioClass(?string $mediaRatio = null): ?string
    {
        return null;
    }

    public function getViewportName(): string
    {
        return strtolower(ElementalConfig::getDefaultViewport());
    }

    public function getContentPaddingClass(string $direction, int $size): string
    {
        return '';
    }

    public function getInitialContentColumnClass(): ?string
    {
        return null;
    }

    public function getMediaColumnOrderClasses(string $mediaPosition): string
    {
        return '';
    }

    public function getContentColumnOrderClasses(string $mediaPosition): string
    {
        return '';
    }

    public function getMediaColumnWidthClass(?string $contentColumnWidth): ?string
    {
        return null;
    }

    public function getContentColumnWidthClass(?string $contentColumnWidth): string
    {
        return '';
    }

    private function getSizeClasses(): array
    {
        $mapping = [
            '0.25' => 'one-quarter',
            '0.33' => 'one-third',
            '0.5' => 'one-half',
            '0.67' => 'two-thirds',
            '0.75' => 'three-quarters',
            '1' => 'full',
        ];

        $classes = [];

        if ($this->baseElement->SizeMD) {
            $size = (string)round($this->baseElement->SizeMD / ElementalConfig::getGridColumnCount(), 2);

            $classes[] = $mapping[$size] ?? $mapping[1];
        }

        if ($this->baseElement->SizeLG) {
            $size = (string)round($this->baseElement->SizeLG / ElementalConfig::getGridColumnCount(), 2);

            $classes[] = ($mapping[$size] ?? $mapping[1]).'-from-desktop';
        }

        foreach ($classes as &$class) {
            $class = sprintf('%s-%s', self::COLUMN_CLASSNAME, $class);
        }

        return $classes;
    }
}
