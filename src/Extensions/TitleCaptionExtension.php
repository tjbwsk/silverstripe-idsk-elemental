<?php

namespace TJBW\IdSkElemental\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class TitleCaptionExtension extends DataExtension
{
    private static $displays_title_caption_field = true;

    private static $db = [
        'Caption' => 'Varchar(255)',
    ];

    private static $field_labels = [
        'Caption' => 'Titulok nad nadpisom',
    ];

    public function updateCMSFields(FieldList $fields)
    {
        if ($this->owner->config()->get('displays_title_caption_field')) {
            $fields->insertBefore('Title', $fields->dataFieldByName('Caption'));
        } else {
            $fields->removeByName('Caption');
        }
    }

    public function getCaptionSizeClass(): string
    {
        return 'govuk-caption-l';
    }
}
