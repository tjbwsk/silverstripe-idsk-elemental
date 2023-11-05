<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldPageCount;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use TJBW\IdSkElemental\Models\Timeline;

/**
 * @see https://idsk.gov.sk/komponenty/timeline
 */
class ElementTimeline extends BaseElement
{
    private static $table_name = 'ElementTimeline';

    private static $icon = 'font-icon-sort';

    private static $singular_name = 'Časová os';
    private static $plural_name = 'Časové osi';
    private static $description = 'Časová os zobrazuje používateľom chronologicky usporiadaný obsah.';

    private static $inline_editable = false;

    private static $db = [
        'Content' => 'HTMLText',
    ];

    private static $field_labels = [
        'Content' => 'Obsah',
    ];

    private static $has_many = [
        'Items' => Timeline\BaseItem::class,
    ];

    private static $owns = [
        'Items',
    ];

    private static $cascade_deletes = [
        'Items',
    ];

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->dataFieldByName('Content')->setRows(5);

            if ($items = $fields->dataFieldByName('Items')) {
                $fields->removeByName('Items');
                $fields->addFieldToTab('Root.Main', $items);

                $items->getConfig()
                    ->addComponent(GridFieldOrderableRows::create('Sort'))
                    ->addComponent(
                        GridFieldAddNewMultiClass::create()
                            ->setClasses([
                                Timeline\SeparatorItem::class,
                                Timeline\TitleItem::class,
                                Timeline\ContentItem::class,
                            ])
                    )
                    ->removeComponentsByType(GridFieldAddNewButton::class)
                    ->removeComponentsByType(GridFieldAddExistingAutocompleter::class)
                    ->removeComponentsByType(GridFieldDeleteAction::class)
                    ->removeComponentsByType(GridFieldPaginator::class)
                    ->removeComponentsByType(GridFieldPageCount::class)
                ;
            }
        });

        return parent::getCMSFields();
    }

    public function getType()
    {
        return 'Časová os';
    }
}
