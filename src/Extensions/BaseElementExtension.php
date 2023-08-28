<?php

namespace TJBW\IdSkElemental\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class BaseElementExtension extends DataExtension
{
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
