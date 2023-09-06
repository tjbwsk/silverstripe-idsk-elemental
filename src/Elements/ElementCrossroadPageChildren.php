<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\ORM\DataObject;

/**
 * @see https://idsk.gov.sk/komponenty/razcestnik
 */
class ElementCrossroadPageChildren extends BaseElement
{
    private static $table_name = 'ElementCrossroadPageChildren';

    private static $icon = 'font-icon-thumbnails';

    private static $singular_name = 'Zoznam podstránok - Rázcestník';
    private static $plural_name = 'Zoznam podstránok - Rázcestníky';
    private static $description = 'Rázcestník má formu jednoduchej dlaždice, zloženej z nadpisu, popisku a oddeľovacej čiary. Jeho účelom je prehľadne a jednoducho zoskupiť resp. usporiadať pre používateľa odkazy na súvisiaci obsah, ktorý je rozmiestnený na rôznych, samostatných podstránkach.';

    private static $inline_editable = false;

    private static $_cache_items = null;

    public function Items()
    {
        return self::$_cache_items ??= $this->getPage()->AllChildren()
            ->filterByCallback(function (DataObject $record) {
                return $record->canView();
            });
    }

    public function getVariant()
    {
        return $this->Items()->count() > 5 ? 'idsk-crossroad-2' : null;
    }

    public function getType()
    {
        return 'Zoznam podstránok - Rázcestník';
    }
}
