<?php

namespace TJBW\IdSkElemental\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class ElementFormExtension extends DataExtension
{
    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('EnableLiveValidation');
    }
}
