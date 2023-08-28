<?php

namespace TJBW\IdSkElemental\Extensions;

use DNADesign\Elemental\Forms\TextCheckboxGroupField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class SiteTreeExtension extends DataExtension
{
    private static $db = [
        'ShowTitle' => 'Boolean(1)',
    ];

    public function populateDefaults()
    {
        $this->owner->ShowTitle = true;
    }

    public function updateCMSFields(FieldList $fields)
    {
        $fields->replaceField(
            'Title',
            TextCheckboxGroupField::create($this->owner->fieldLabel('Title')),
        );
    }
}
