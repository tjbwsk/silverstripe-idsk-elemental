<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;

/**
 * @see https://idsk.gov.sk/komponenty/oznacenie-verzie-sluzby
 */
class ElementPhaseBanner extends BaseElement
{
    private static $table_name = 'ElementPhaseBanner';

    private static $icon = 'font-icon-block-info';

    private static $singular_name = 'Verzia služby';
    private static $plural_name = 'Verzia služby';
    private static $description = 'Označenie testovacej verzie služby a novo spustenej služby.';

    private static $displays_title_caption_field = false;
    private static $displays_title_tag_field = false;
    private static $displays_title_class_field = false;
    private static $displays_title_in_template = false;
    private static $displays_remove_component_bottom_margin_field = false;

    private static $db = [
        'Content' => 'HTMLText',
    ];

    private static $field_labels = [
        'Content' => 'Obsah',
    ];

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->dataFieldByName('Content')->setRows(2);
        });

        return parent::getCMSFields();
    }

    public function getType()
    {
        return 'Verzia služby';
    }
}
