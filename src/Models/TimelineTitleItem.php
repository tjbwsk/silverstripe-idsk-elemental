<?php

namespace TJBW\IdSkElemental\Models;

class TimelineTitleItem extends TimelineBaseItem
{
    private static $table_name = 'TimelineTitleItem';

    private static $singular_name = 'Nadpis';
    private static $plural_name = 'Nadpisy';

    private static $db = [
        'Title' => 'Varchar(255)',
    ];

    public function forTemplate()
    {
        return $this->renderWith('Rasstislav/IdSk/Includes/Components/Timeline/TimelineTitle');
    }
}
