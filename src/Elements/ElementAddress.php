<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use TJBW\IdSkElemental\Extensions\ElementVariation;

/**
 * @see https://idsk.gov.sk/komponenty/adresa
 */
class ElementAddress extends BaseElement
{
    private static $extensions = [
        ElementVariation::class,
    ];

    private static $table_name = 'ElementAddress';

    private static $icon = 'font-icon-block-globe';

    private static $singular_name = 'Adresa';
    private static $plural_name = 'Adresy';
    private static $description = 'Adresa a zobrazenie údajov v mape.';

    private static $db = [
        'PrimaryTitle' => 'Varchar(255)',
        'SecondaryTitle' => 'Varchar(255)',
        'Content' => 'HTMLText',
        'URL' => 'Varchar(2083)',
    ];

    private static $field_labels = [
        'PrimaryTitle' => 'Hlavný nadpis (H2)',
        'SecondaryTitle' => 'Vedľajší nadpis (H3)',
        'URL' => 'Odkaz na mapu (URL)',
    ];

    private static $variants = [
        'idsk-address--full-width' => 'Celá šírka',
    ];

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->dataFieldByName('Content')->setRows(5);
        });

        return parent::getCMSFields();
    }

    public function getType()
    {
        return 'Adresa';
    }
}
