<?php

namespace TJBW\IdSkElemental\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class AccordionPanelExtension extends DataExtension
{
    private static $db = [
        'Summary' => 'Varchar(255)',
    ];

    private static $field_labels = [
        'Summary' => 'Zhrnutie',
    ];

    public function updateSummaryFields(&$fields)
    {
        unset($fields['Image.CMSThumbnail']);
    }

    public function updateCMSFields(FieldList $fields)
    {
        $fields->insertAfter('Title', $fields->dataFieldByName('Summary'));

        $fields->removeByName('Image');
        $fields->removeByName('ElementLink');

        $titleField = $fields->dataFieldByName('Title');

        $fields->removeByName('Title');

        $fields->insertBefore('Summary', $titleField);
    }
}
