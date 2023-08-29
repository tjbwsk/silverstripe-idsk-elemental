<?php

namespace TJBW\IdSkElemental\Models;

use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataObject;
use SilverStripe\Versioned\Versioned;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use TJBW\IdSkElemental\Elements\ElementTimeline;

class TimelineBaseItem extends DataObject
{
    private static $extensions = [
        Versioned::class,
    ];

    private static $table_name = 'TimelineBaseItem';

    private static $db = [
        'Sort' => 'Int',
     ];

    private static $has_one = [
        'Timeline' => ElementTimeline::class,
    ];

    private static $summary_fields = [
        'ClassType',
        'Title',
        'Date',
        'Time',
    ];

    private static $field_labels = [
        'ClassType' => 'Typ',
        'Title' => 'Nadpis',
        'Date' => 'Dátum',
        'Time' => 'Čas',
    ];

    private static $default_sort = '"Sort" ASC';

    public function summaryFields()
    {
        $summaryFields = parent::summaryFields();

        $summaryFields['Title'] = [
            'title' => 'Nadpis / popis',
            'callback' => fn ($record, $columnName) => $record->dbObject($columnName),
        ];

        return $summaryFields;
    }

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->removeByName('Sort');
            $fields->removeByName('TimelineID');
        });

        return parent::getCMSFields();
    }

    public function getClassType()
    {
        return $this->owner->i18n_singular_name();
    }
}
