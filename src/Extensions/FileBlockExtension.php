<?php

namespace TJBW\IdSkElemental\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class FileBlockExtension extends DataExtension
{
    private static $max_upload_size = [];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->dataFieldByName('File')->getValidator()
            ->setAllowedMaxFileSize($this->owner->config()->get('max_upload_size'));
    }
}
