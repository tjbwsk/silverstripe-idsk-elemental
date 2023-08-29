<?php

namespace TJBW\IdSkElemental\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class ElementAccordionExtension extends DataExtension
{
    public function updateCMSFields(FieldList $fields)
    {
        $fields->dataFieldByName('Content')->setDescription(null);
    }
}
