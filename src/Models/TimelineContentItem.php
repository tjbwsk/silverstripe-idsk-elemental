<?php

namespace TJBW\IdSkElemental\Models;

use SilverStripe\Forms\FieldList;
use TJBW\IdSkElemental\Forms\NullableTimeField;

class TimelineContentItem extends TimelineBaseItem
{
    private static $table_name = 'TimelineContentItem';

    private static $singular_name = 'Popis';
    private static $plural_name = 'Popisy';

    private static $db = [
        'Title' => 'HTMLText',
        'Date' => 'Date',
        'Time' => 'Time',
    ];

    private static $field_labels = [
        'Title' => 'Popis',
        'Date' => 'Dátum',
        'Time' => 'Čas',
    ];

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->dataFieldByName('Title')->setRows(3);

            $fields->replaceField('Time', NullableTimeField::create('Time', $this->fieldLabel('Time')));
        });

        return parent::getCMSFields();
    }

    public function forTemplate()
    {
        return $this->customise([
            'Content' => $this->dbObject('Title'),
            'Date' => $this->dbObject('Date')->Nice(),
            'Time' => $this->dbObject('Time')->Short(),
        ])->renderWith('Rasstislav/IdSk/Includes/Components/Timeline/TimelineContent');
    }
}
