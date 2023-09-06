<?php

namespace TJBW\IdSkElemental\Models\Crossroad;

use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataObject;
use SilverStripe\Versioned\Versioned;
use TJBW\IdSkElemental\Elements\ElementCrossroad;

class Item extends DataObject
{
    private static $extensions = [
        Versioned::class,
    ];

    private static $table_name = 'CrossroadItem';

    private static $db = [
        'Sort' => 'Int',
        'Title' => 'Varchar(50)',
        'Subtitle' => 'Varchar(120)',
    ];

    private static $has_one = [
        'Crossroad' => ElementCrossroad::class,
        'Link' => Link::class,
    ];

    private static $cascade_deletes = [
        'Link',
    ];

    private static $cascade_duplicates = [
        'Link',
    ];

    private static $summary_fields = [
        'Title',
        'Link.LinkURL',
    ];

    private static $field_labels = [
        'Title' => 'Titulok',
        'Subtitle' => 'Popis',
        'Link' => 'Odkaz',
        'Link.LinkURL' => 'Odkaz',
    ];

    private static $default_sort = '"Sort" ASC';

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->removeByName('Sort');
            $fields->removeByName('CrossroadID');

            $fields->replaceField('LinkID',
                LinkField::create(
                    'Link',
                    $this->fieldLabel('Link'),
                    $this,
                    [
                        'types' => [
                            'SiteTree',
                            'URL',
                        ],
                    ],
                )
            );
        });

        return parent::getCMSFields();
    }
}
