<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\ElementalList\Model\ElementList;

/**
 * @see https://idsk.gov.sk/komponenty/zalozky
 */
class ElementTab extends ElementList
{
    private static $table_name = 'ElementTab';

    private static $icon = 'font-icon-block-tabs';

    private static $singular_name = 'Záložka';
    private static $plural_name = 'Záložka';
    private static $description = 'Záložka v komponente Záložky.';

    private static $displays_title_caption_field = false;

    private static $disallowed_elements = [
        ElementTabs::class,
        self::class,
    ];

    public function getType()
    {
        return 'Záložka';
    }
}
