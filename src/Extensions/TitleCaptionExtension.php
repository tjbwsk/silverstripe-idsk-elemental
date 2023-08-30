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
        $titleSizeClasses = [
            'h1' => 'govuk-caption-xl',
            'h2' => 'govuk-caption-l',
            'h3' => 'govuk-caption-m',
        ];

        if (!$this->owner->TitleClass) {
            return 'govuk-caption-l';
        }

        return $titleSizeClasses[$this->owner->TitleClass] ?? 'govuk-caption-m';
    }
}
