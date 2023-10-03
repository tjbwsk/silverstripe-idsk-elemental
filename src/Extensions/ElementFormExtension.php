<?php

namespace TJBW\IdSkElemental\Extensions;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class ElementFormExtension extends DataExtension
{
    private static $db = [
        'ShowCounterOnFieldGroups' => 'Boolean',
        'StartButton' => 'Boolean',
    ];

    private static $field_labels = [
        'ShowCounterOnFieldGroups' => 'Zobraziť očíslovanie obaľovacích skupín',
        'StartButton' => 'Spúšťacie tlačidlo odoslania (so šípkou)',
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('EnableLiveValidation');
    }

    public function updateFormOptions(&$options)
    {
        $options->insertBefore('ShowClearButton', CheckboxField::create(
            'ShowCounterOnFieldGroups',
            $this->owner->fieldLabel('ShowCounterOnFieldGroups'),
            $this->owner->ShowCounterOnFieldGroups,
        ));

        $options->insertBefore('ShowClearButton', CheckboxField::create(
            'StartButton',
            $this->owner->fieldLabel('StartButton'),
            $this->owner->StartButton,
        ));
    }
}
