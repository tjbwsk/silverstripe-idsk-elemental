<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\Elemental\Models\BaseElement;
use DNADesign\ElementalVirtual\Model\ElementVirtual;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Control\Controller;
use SilverStripe\Forms\FieldList;
use SilverStripe\View\TemplateGlobalProvider;

/**
 * @see https://idsk.gov.sk/komponenty/oznacenie-verzie-sluzby
 */
class ElementPhaseBanner extends BaseElement implements TemplateGlobalProvider
{
    private static $table_name = 'ElementPhaseBanner';

    private static $icon = 'font-icon-block-info';

    private static $singular_name = 'Verzia služby';
    private static $plural_name = 'Verzia služby';
    private static $description = 'Označenie testovacej verzie služby a novo spustenej služby.';

    private static $displays_title_caption_field = false;
    private static $displays_title_in_template = false;

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

    public static function getElementPhaseBannerIfFirst()
    {
        if (
            (
                ($currRecord = Controller::curr()->data()) instanceof SiteTree
                || ($currRecord = $currRecord instanceof BaseElement ? $currRecord->Parent()->getOwnerPage() : null)
            )
            && ($firstElement = $currRecord->ElementalArea()->Elements()->first())
            && (
                $firstElement instanceof static
                || (
                    class_exists(ElementVirtual::class)
                    && $firstElement instanceof ElementVirtual
                    && $firstElement->LinkedElement() instanceof static
                )
            )
        ) {
            return $firstElement;
        }

        return null;
    }

    public static function get_template_global_variables()
    {
        return [
            'MainElementPhaseBanner' => 'getElementPhaseBannerIfFirst',
        ];
    }
}
