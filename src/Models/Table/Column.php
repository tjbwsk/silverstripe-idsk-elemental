<?php

namespace TJBW\IdSkElemental\Models\Table;

use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataObject;

class Column extends DataObject
{
    private static $table_name = 'TableColumn';

    private static $singular_name = 'Stĺpec tabuľky';
    private static $plural_name = 'Stĺpce tabuľky';

    private static $db = [
        'Content' => 'HTMLText',
    ];

    private static $has_one = [
        'Row' => Row::class,
    ];

    private static $field_labels = [
        'Content' => 'Obsah',
        'Row' => 'Riadok tabuľky',
    ];

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->removeByName('RowID');

            $fields->dataFieldByName('Content')->setRows(5);
        });

        return parent::getCMSFields();
    }

    public function getTitle()
    {
        return $this->Content;
    }

    public function canDelete($member = null)
    {
        return false;
    }
}
