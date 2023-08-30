<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\Elemental\Models\BaseElement;
use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;
use SilverStripe\Forms\FieldList;
use TJBW\IdSkElemental\Extensions\ElementVariation;

/**
 * @see https://idsk.gov.sk/komponenty/tlacidla
 */
class ElementButton extends BaseElement
{
    private static $extensions = [
        ElementVariation::class,
    ];

    private static $table_name = 'ElementButton';

    private static $icon = 'font-icon-block-link';

    private static $singular_name = 'Tlačidlo';
    private static $plural_name = 'Tlačidlá';
    private static $description = 'Zobrazuje tlačidlo s odkazom.';

    private static $displays_title_caption_field = false;
    private static $displays_title_tag_field = false;
    private static $displays_title_class_field = false;
    private static $displays_title_in_template = false;

    private static $db = [
        'StartButton' => 'Boolean',
    ];

    private static $has_one = [
        'Action' => Link::class,
    ];

    private static $field_labels = [
        'Title' => 'Interný názov',
        'StartButton' => 'Spúšťacie tlačidlo (so šípkou)',
        'Action' => 'Odkaz',
    ];

    private static $variants = [
        'idsk-button--secondary' => 'Sekundárne (sivé)',
        'idsk-button--warning' => 'Výstražné (červené)',
    ];

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->replaceField('ActionID',
                LinkField::create(
                    'Action',
                    $this->fieldLabel('Action'),
                    $this,
                )
            );

            $fields->insertBefore('StartButton', $fields->dataFieldByName('Action'));
        });

        return parent::getCMSFields();
    }

    public function getType()
    {
        return 'Tlačidlo';
    }
}
