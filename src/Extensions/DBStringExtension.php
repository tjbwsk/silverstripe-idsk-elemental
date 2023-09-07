<?php

namespace TJBW\IdSkElemental\Extensions;

use SilverStripe\Core\Convert;
use SilverStripe\Core\Extension;

class DBStringExtension extends Extension
{
    private static $casting = [
        'Slug' => 'Text',
    ];

    public function RAW2URL()
    {
        return Convert::raw2url($this->owner->Plain());
    }
}
