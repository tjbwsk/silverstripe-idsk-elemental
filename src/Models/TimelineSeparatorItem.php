<?php

namespace TJBW\IdSkElemental\Models;

class TimelineSeparatorItem extends TimelineBaseItem
{
    private static $table_name = 'TimelineSeparatorItem';

    private static $singular_name = 'Oddeľovač';
    private static $plural_name = 'Oddeľovače';

    private static $db = [
        'Title' => 'Varchar(255)',
    ];

    public function forTemplate()
    {
        return $this->renderWith('Rasstislav/IdSk/Includes/Components/Timeline/TimelineSeparator');
    }
}
