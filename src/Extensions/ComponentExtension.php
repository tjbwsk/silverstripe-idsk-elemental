<?php

namespace TJBW\IdSkElemental\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class ComponentExtension extends DataExtension
{
    private static $displays_remove_component_bottom_margin_field = true;

    private static $db = [
        'RemoveComponentBottomMargin' => 'Boolean(1)',
    ];

    private static $field_labels = [
        'RemoveComponentBottomMargin' => 'Odstrániť spodnú medzeru',
    ];

    public function updateCMSFields(FieldList $fields)
    {
        if ($removeComponentBottomMarginField = $fields->dataFieldByName('RemoveComponentBottomMargin')) {
            $fields->removeByName('RemoveComponentBottomMargin');

            if ($this->owner->config()->get('displays_remove_component_bottom_margin_field')) {
                $fields->addFieldToTab('Root.Settings', $removeComponentBottomMarginField);
            }
        }
    }
}
