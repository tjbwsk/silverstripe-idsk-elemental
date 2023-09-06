<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use TJBW\IdSkElemental\Extensions\ElementVariation;
use TJBW\IdSkElemental\Models\Crossroad;

/**
 * @see https://idsk.gov.sk/komponenty/razcestnik
 */
class ElementCrossroad extends BaseElement
{
    private static $extensions = [
        ElementVariation::class,
    ];

    private static $table_name = 'ElementCrossroad';

    private static $icon = 'font-icon-thumbnails';

    private static $singular_name = 'Rázcestník';
    private static $plural_name = 'Rázcestníky';
    private static $description = 'Rázcestník má formu jednoduchej dlaždice, zloženej z nadpisu, popisku a oddeľovacej čiary. Jeho účelom je prehľadne a jednoducho zoskupiť resp. usporiadať pre používateľa odkazy na súvisiaci obsah, ktorý je rozmiestnený na rôznych, samostatných podstránkach.';

    private static $inline_editable = false;

    private static $has_many = [
        'Items' => Crossroad\Item::class,
    ];

    private static $owns = [
        'Items',
    ];

    private static $cascade_deletes = [
        'Items',
    ];

    private static $field_labels = [
        'Items' => 'Dlaždice',
    ];

    private static $variants = [
        'idsk-crossroad-2' => 'Dva stĺpce',
    ];

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            if ($itemsGF = $fields->dataFieldByName('Items')) {
                $fields->removeByName('Items');

                $itemsGFConfig = $itemsGF->getConfig();

                $itemsGFConfig->getComponentByType(GridFieldDeleteAction::class)
                    ->setRemoveRelation(false);

                $itemsGFConfig
                    ->removeComponentsByType(GridFieldAddExistingAutocompleter::class)
                    ->addComponent(GridFieldOrderableRows::create('Sort'))
                ;

                $fields->addFieldToTab('Root.Main', $itemsGF);
            }
        });

        return parent::getCMSFields();
    }

    public function getType()
    {
        return 'Rázcestník';
    }
}
