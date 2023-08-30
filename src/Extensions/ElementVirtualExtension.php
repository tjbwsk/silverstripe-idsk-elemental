<?php

namespace TJBW\IdSkElemental\Extensions;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;

class ElementVirtualExtension extends DataExtension
{
    public function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName('Title');
    }
}
