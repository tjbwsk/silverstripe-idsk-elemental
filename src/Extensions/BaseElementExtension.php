<?php

namespace TJBW\IdSkElemental\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class BaseElementExtension extends DataExtension
{
    public function onAfterWrite()
    {
        if (($topPage = $this->owner->TopPage())->isInDB()) {
            $topPage->write();
        }
    }

    public function onBeforePublish()
    {
        if (($topPage = $this->owner->TopPage())->isInDB()) {
            $topPage->publishSingle();
        }
    }

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('ExtraClass');
    }

    public function getTitleTag(): string
    {
        return 'h2';
    }

    public function getTitleSizeClass(): string
    {
        return 'govuk-heading-l';
    }
}
