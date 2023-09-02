<?php

namespace TJBW\IdSkElemental\Elements;

use Arillo\MultiSelectField\MultiSelectField;
use DNADesign\Elemental\Models\BaseElement;
use DNADesign\ElementalList\Model\ElementList;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Versioned\GridFieldArchiveAction;
use TJBW\IdSkElemental\Controllers\ElementInPageNavigationController;

/**
 * @see https://idsk.gov.sk/komponenty/in-page-navigation
 */
class ElementInPageNavigation extends ElementList
{
    private static $table_name = 'ElementInPageNavigation';

    private static $icon = 'font-icon-block-layout-6';

    private static $singular_name = 'Navigácia na stránke';
    private static $plural_name = 'Navigácia na stránke';
    private static $description = 'Navigácia na stránke zobrazuje používateľovi prehľad obsahu danej stránky (na základe použitých nadpisov v rámci stránky).';

    private static $inline_editable = false;

    private static $many_many = [
        'NavigationItems' => BaseElement::class,
    ];

    private static $field_labels = [
        'NavigationItems' => 'Navigácia',
    ];

    private static $_elements_ids = null;

    public function onBeforeDelete()
    {
        parent::onBeforeDelete();

        $this->NavigationItems()->removeAll();
    }

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            if ($navigationItems = $fields->dataFieldByName('NavigationItems')) {
                if (class_exists(MultiSelectField::class)) {
                    if (($elements = $this->Elements()->Elements())->exists()) {
                        $fields->replaceField('NavigationItems',
                            MultiSelectField::create(
                                'NavigationItems',
                                $this->fieldLabel('NavigationItems'),
                                $this,
                                false,
                                $elements,
                            )
                        );
                    } else {
                        $fields->addFieldToTab('Root.NavigationItems', LiteralField::create(
                            'NavigationItemsMessage',
                            '<p class="message notice">Položky do navigácie je možné pridávať až po pridaní blokov!</p>',
                        ));

                        $fields->removeFieldFromTab('Root.NavigationItems', 'NavigationItems');
                    }
                } else {
                    $navigationItems->getConfig()
                        ->removeComponentsByType(GridFieldAddNewButton::class)
                        ->removeComponentsByType(GridFieldArchiveAction::class)
                    ;
                }
            }
        });

        return parent::getCMSFields();
    }

    public function getExistingNavigationItems()
    {
        $navigationItems = $this->NavigationItems();

        return ($navigationItems->exists() && ($elementsIDs = $this->getElementsIDs())) ? $navigationItems->filter(
            'ID',
            $elementsIDs,
        ) : null;
    }

    private function getElementsIDs()
    {
        return self::$_elements_ids ??= $this->Elements()->Elements()->column('ID');
    }

    public function getType()
    {
        return 'Navigácia na stránke';
    }
}
