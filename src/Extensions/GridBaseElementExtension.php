<?php

namespace TJBW\IdSkElemental\Extensions;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use TJBW\IdSkElemental\CSSFramework\IdSkCSSFramework;
use TJBW\IdSkElemental\Forms\TitleInputGroupField;
use WeDevelop\ElementalGrid\CSSFramework\CSSFrameworkInterface;
use WeDevelop\ElementalGrid\ElementalConfig;
use WeDevelop\ElementalGrid\Models\ElementRow;

class GridBaseElementExtension extends DataExtension
{
    private static $displays_title_tag_field = true;
    private static $displays_title_class_field = true;

    private CSSFrameworkInterface $cssFramework;

    public function setOwner($owner)
    {
        parent::setOwner($owner);

        $this->cssFramework = new IdSkCSSFramework($this->owner);
    }

    public function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName('HeadingXS');
        $fields->removeByName('SizeXS');
        $fields->removeByName('OffsetXS');
        $fields->removeByName('VisibilityXS');

        $fields->removeByName('HeadingSM');
        $fields->removeByName('SizeSM');
        $fields->removeByName('OffsetSM');
        $fields->removeByName('VisibilitySM');

        $fields->removeByName('OffsetMD');
        $fields->removeByName('VisibilityMD');

        $fields->removeByName('OffsetLG');
        $fields->removeByName('VisibilityLG');

        $fields->removeByName('HeadingXL');
        $fields->removeByName('SizeXL');
        $fields->removeByName('OffsetXL');
        $fields->removeByName('VisibilityXL');

        if (!$this->owner->config()->get('displays_title_tag_field')) {
            $fields->removeByName('TitleTag');
        }

        if (!$this->owner->config()->get('displays_title_class_field')) {
            $fields->removeByName('TitleClass');
        }

        if ($titleTagField = $fields->dataFieldByName('TitleTag')) {
            $titleTagField->setSource([
                'h1' => 'H1',
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
            ])->setEmptyString('Úroveň');
        }

        if ($titleClassField = $fields->dataFieldByName('TitleClass')) {
            $titleClassField->setSource([
                'h1' => 'XL',
                'h2' => 'L',
                'h3' => 'M',
                'h4' => 'S',
            ])->setEmptyString('Štýl');
        }

        $captionField = $fields->dataFieldByName('Caption');

        $fields->removeByName('TitleSettings');

        $fields->findOrMakeTab('Root.Main')->unshift(
            TitleInputGroupField::create(
                $titleTagField,
                $titleClassField,
                $this->owner->config()->get('displays_title_in_template'),
                $this->owner->fieldLabel('Title'),
            )->setName('Title'),
        );

        if ($captionField) {
            $fields->findOrMakeTab('Root.Main')->unshift($captionField);
        }
    }

    public function getColumnClasses(): string
    {
        return trim(implode(' ', [$this->owner->getCSSFramework()->getColumnClasses(), $this->owner->ExtraClass]));
    }

    public function getCSSFramework(): CSSFrameworkInterface
    {
        return $this->cssFramework;
    }

    public function getTitleTag(): string
    {
        $titleTag = ElementalConfig::getDefaultTitleTag();

        if ($this->owner->config()->get('displays_title_tag_field')) {
            $titleTag = $this->owner->getField('TitleTag') ?: $titleTag;
        }

        return $titleTag;
    }

    public function getTitleClass(): string
    {
        $titleClass = $this->owner->getCSSFramework()->getDefaultTitleSize();

        if ($this->owner->config()->get('displays_title_class_field')) {
            $titleClass = $this->owner->getField('TitleClass') ?: $titleClass;
        }

        return $titleClass;
    }

    public function getTitleSizeClass(): string
    {
        return $this->owner->getCSSFramework()->getTitleSizeClass();
    }

    public function getAnchorTitle(): string
    {
        if (!($ID = $this->owner->ID) && $this->owner instanceof ElementRow) {
            $ID = $this->owner->Parent()->ID;
        }

        return $this->owner->singular_name() . '_' . $this->owner->getTitle() . '_' . $ID;
    }
}
