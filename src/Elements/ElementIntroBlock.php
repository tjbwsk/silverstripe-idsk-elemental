<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\Elemental\Models\BaseElement;
use Heyday\MenuManager\MenuItem;
use Rasstislav\IdSk\Forms\IntroBlockSearchForm;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormField;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TreeDropdownField;
use Symbiote\GridFieldExtensions\GridFieldEditableColumns;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use TJBW\IdSkElemental\Extensions\ElementVariation;
use TJBW\IdSkElemental\Forms\GridField\GridFieldAddNewInlineButton;

/**
 * @see https://idsk.gov.sk/komponenty/intro-block
 */
class ElementIntroBlock extends BaseElement
{
    private static $extensions = [
        ElementVariation::class,
    ];

    private static $table_name = 'ElementIntroBlock';

    private static $icon = 'font-icon-block-layout-3';

    private static $singular_name = 'Úvodný blok';
    private static $plural_name = 'Úvodné bloky';
    private static $description = 'Úvodný blok stránky slúži ako jedna z foriem navigácie používateľa po webovom sídle.';

    private static $inline_editable = false;
    private static $displays_title_in_template = false;

    private static $db = [
        'Content' => 'HTMLText',
        'ShowSearchForm' => 'Boolean',
        'BottomMenuTitle' => 'Varchar(55)',
        'SideMenuTitle' => 'Varchar(55)',
    ];

    private static $many_many = [
        'BottomMenuItems' => MenuItem::class,
        'SideMenuItems' => MenuItem::class,
    ];

    private static $field_labels = [
        'Content' => 'Obsah',
        'ShowSearchForm' => 'Zobraziť vyhľadávanie',
        'BottomMenuTitle' => 'Nadpis pre najčastejšie hľadané výrazy',
        'SideMenuTitle' => 'Nadpis pre populárny obsah',
        'BottomMenuItems' => 'Odkazy pre najčastejšie hľadané výrazy',
        'SideMenuItems' => 'Odkazy pre populárny obsah',
    ];

    private static $variants = [
        'app-pane-transparent' => 'Transparentné zobrazenie',
        'app-pane-blue' => 'Modré zobrazenie',
    ];

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->dataFieldByName('Content')->setRows(5);

            $fields->insertAfter('Main', Tab::create('SearchOptions', 'Vyhľadávanie'));
            $fields->insertAfter('SearchOptions', Tab::create('SideMenuOptions', 'Populárny obsah'));

            $fields->addFieldsToTab('Root.SearchOptions', [
                $fields->dataFieldByName('ShowSearchForm'),
                $fields->dataFieldByName('BottomMenuTitle'),
            ]);

            $fields->addFieldsToTab('Root.SideMenuOptions', [
                $fields->dataFieldByName('SideMenuTitle'),
            ]);

            $fieldsToDisplay = [];

            foreach (singleton(MenuItem::class)->getCMSFields()->fieldByName('Root.main')->Fields() as $field) {
                $fieldsToDisplay[$field->getName()] = [
                    'title' => $field->Title(),
                    'callback' => function ($record, $column, $grid) use ($field) {
                        $field = clone $field;

                        if ($field instanceof TreeDropdownField) {
                            $field->setForm($grid->getForm());
                        }

                        return $field->setTemplate(FormField::class.'_holder_tiny');
                    },
                ];
            }

            if ($bottomMenuItemsGF = $fields->dataFieldByName('BottomMenuItems')) {
                $fields->removeByName('BottomMenuItems');

                $bottomMenuItemsGFConfig = $bottomMenuItemsGF->getConfig();

                $bottomMenuItemsGFConfig->getComponentByType(GridFieldDeleteAction::class)
                    ->setRemoveRelation(false);

                $bottomMenuItemsGFDataColumns = $bottomMenuItemsGFConfig
                    ->getComponentByType(GridFieldDataColumns::class);

                $bottomMenuItemsGFConfig
                    ->removeComponentsByType(GridFieldAddExistingAutocompleter::class)
                    ->addComponent(GridFieldOrderableRows::create('Sort'))
                    ->addComponent(
                        GridFieldEditableColumns::create()
                            ->setDisplayFields($fieldsToDisplay),
                        GridFieldDataColumns::class,
                    )
                    ->removeComponent($bottomMenuItemsGFDataColumns)
                    ->removeComponentsByType(GridFieldAddNewButton::class)
                    ->addComponent(GridFieldAddNewInlineButton::create())
                ;

                $fields->addFieldToTab('Root.SearchOptions', $bottomMenuItemsGF);
            }

            if ($sideMenuItemsGF = $fields->dataFieldByName('SideMenuItems')) {
                $fields->removeByName('SideMenuItems');

                $sideMenuItemsGFConfig = $sideMenuItemsGF->getConfig();

                $sideMenuItemsGFConfig->getComponentByType(GridFieldDeleteAction::class)
                    ->setRemoveRelation(false);

                $sideMenuItemsGFDataColumns = $sideMenuItemsGFConfig
                    ->getComponentByType(GridFieldDataColumns::class);

                $sideMenuItemsGFConfig
                    ->removeComponentsByType(GridFieldAddExistingAutocompleter::class)
                    ->addComponent(GridFieldOrderableRows::create('Sort'))
                    ->addComponent(
                        GridFieldEditableColumns::create()
                            ->setDisplayFields($fieldsToDisplay),
                        GridFieldDataColumns::class,
                    )
                    ->removeComponent($sideMenuItemsGFDataColumns)
                    ->removeComponentsByType(GridFieldAddNewButton::class)
                    ->addComponent(GridFieldAddNewInlineButton::create())
                ;

                $fields->addFieldToTab('Root.SideMenuOptions', $sideMenuItemsGF);
            }
        });

        return parent::getCMSFields();
    }

    public function IntroBlockSearchForm()
    {
        $introBlockSearchForm = IntroBlockSearchForm::create($this->getController());

        $this->extend('updateIntroBlockSearchForm', $introBlockSearchForm);

        return $introBlockSearchForm;
    }

    public function getType()
    {
        return 'Úvodný blok';
    }
}
