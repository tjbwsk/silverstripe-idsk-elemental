<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use TJBW\IdSkElemental\Extensions\ElementVariation;

/**
 * @see https://idsk.gov.sk/komponenty/informacna-lista-lista-s-varovanim
 */
class ElementWarningText extends BaseElement
{
    private static $extensions = [
        ElementVariation::class,
    ];

    private static $table_name = 'ElementWarningText';

    private static $icon = 'font-icon-block-microphone';

    private static $singular_name = 'Informačná lišta / Lišta s varovaním';
    private static $plural_name = 'Informačné lišty / Lišty s varovaním';
    private static $description = 'Lištu použite vtedy, keď chcete niečo zdôrazniť alebo na niečo upozorniť. K dispozícii sú dva typy lišty.';

    private static $displays_title_caption_field = false;
    private static $displays_title_tag_field = false;
    private static $displays_title_class_field = false;
    private static $displays_title_in_template = false;

    private static $db = [
        'Content' => 'HTMLText',
    ];

    private static $field_labels = [
        'Title' => 'Interný názov',
        'Content' => 'Obsah',
    ];

    private static $variants = [
        'idsk-warning-text--info' => 'Informačná lišta',
    ];

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->dataFieldByName('Content')->setRows(3);
        });

        return parent::getCMSFields();
    }

    public function getType()
    {
        return 'Informačná lišta / Lišta s varovaním';
    }
}
