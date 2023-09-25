<?php

namespace TJBW\IdSkElemental\Extensions;

use DNADesign\Elemental\Forms\TextCheckboxGroupField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use TJBW\IdSkElemental\Models\ElementalArea;

class SiteTreeExtension extends DataExtension
{
    private static $db = [
        'ShowTitle' => 'Boolean(1)',
    ];

    private static $has_one = [
        'HeaderElementalArea' => ElementalArea::class,
        'FooterElementalArea' => ElementalArea::class,
    ];

    private static $owns = [
        'HeaderElementalArea',
        'FooterElementalArea',
    ];

    private static $cascade_duplicates = [
        'HeaderElementalArea',
        'FooterElementalArea',
    ];

    private static $allowed_header_types = [];
    private static $allowed_footer_types = [];

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

        if ($headerArea = $fields->dataFieldByName('HeaderElementalArea')) {
            $list = [];

            foreach ($this->owner->config()->get('allowed_header_types') as $availableClass) {
                $inst = singleton($availableClass);

                if ($inst->canCreate()) {
                    if ($inst->hasMethod('canCreateElement') && !$inst->canCreateElement()) {
                        continue;
                    }

                    $list[$availableClass] = $inst->getType();
                }
            }

            if ($this->owner->config()->get('sort_types_alphabetically') !== false) {
                asort($list);
            }

            $headerArea->setTypes($list);
        }

        if ($footerArea = $fields->dataFieldByName('FooterElementalArea')) {
            $fields->insertAfter('ElementalArea', $footerArea);

            $list = [];

            foreach ($this->owner->config()->get('allowed_footer_types') as $availableClass) {
                $inst = singleton($availableClass);

                if ($inst->canCreate()) {
                    if ($inst->hasMethod('canCreateElement') && !$inst->canCreateElement()) {
                        continue;
                    }

                    $list[$availableClass] = $inst->getType();
                }
            }

            if ($this->owner->config()->get('sort_types_alphabetically') !== false) {
                asort($list);
            }

            $footerArea->setTypes($list);
        }
    }
}
