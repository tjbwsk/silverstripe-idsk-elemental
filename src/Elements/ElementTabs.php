<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\ElementalList\Model\ElementList;

/**
 * @see https://idsk.gov.sk/komponenty/zalozky
 */
class ElementTabs extends ElementList
{
    private static $table_name = 'ElementTabs';

    private static $icon = 'font-icon-block-tabs';

    private static $singular_name = 'Záložky';
    private static $plural_name = 'Záložky';
    private static $description = 'Komponent záložky umožňuje používateľom prechádzať medzi súvisiacimi časťami obsahu, pričom sa zobrazuje vždy jedna časť.';

    private static $displays_remove_component_bottom_margin_field = true;
    private static $stop_element_inheritance = true;

    private static $allowed_elements = [
        ElementTab::class,
    ];

    public function getType()
    {
        return 'Záložky';
    }
}
