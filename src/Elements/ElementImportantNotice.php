<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\Elemental\Models\BaseElement;

/**
 * @see https://idsk.gov.sk/komponenty/typografia#pravny-text
 */
class ElementImportantNotice extends BaseElement
{
    private static $table_name = 'ElementImportantNotice';

    private static $icon = 'font-icon-attention';

    private static $singular_name = 'Oznámenie';
    private static $plural_name = 'Oznámenia';
    private static $description = 'Zobrazuje oznam s varovaním.';

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

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->dataFieldByName('Content')->setRows(2);

        return $fields;
    }

    public function getType()
    {
        return 'Oznámenie';
    }
}
