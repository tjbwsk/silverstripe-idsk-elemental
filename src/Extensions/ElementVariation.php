<?php

namespace TJBW\IdSkElemental\Extensions;

use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class ElementVariation extends DataExtension
{
    private static $db = [
        'Variation' => 'Varchar(255)',
    ];

    private static $variants = [];

    public function updateCMSFields(FieldList $fields)
    {
        $variants = $this->owner->config()->get('variants');

        if ($variants && count($variants ?? []) > 0) {
            $variationDropdown = DropdownField::create('Variation', 'Úprava vzhľadu', $variants)
                ->setEmptyString('Základné zobrazenie');

            $fields->replaceField('Variation', $variationDropdown);
            $fields->addFieldToTab('Root.Settings', $variationDropdown);
        } else {
            $fields->removeByName('Variation');
        }
    }

    public function getVariant()
    {
        $variation = $this->owner->Variation;

        if (!isset($this->owner->config()->get('variants')[$variation])) {
            $variation = '';
        }

        return $variation;
    }
}
