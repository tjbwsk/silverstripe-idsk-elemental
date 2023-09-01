<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldFilterHeader;
use SilverStripe\Forms\TextField;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use TJBW\IdSkElemental\Elements\ElementTable;
use TJBW\IdSkElemental\Forms\GridField\GridFieldAddNewInlineButton;
use TJBW\IdSkElemental\Forms\GridField\GridFieldEditableColumns;
use TJBW\IdSkElemental\Models\Table;

/**
 * @see https://idsk.gov.sk/komponenty/tabulky
 */
class ElementTable extends BaseElement
{
    private static $table_name = 'ElementTable';

    private static $icon = 'font-icon-block-table-data';

    private static $singular_name = 'Tabuľka';
    private static $plural_name = 'Tabuľky';
    private static $description = 'Komponent tabuľka použite ak chcete používateľom prehľadne zobraziť údaje.';

    private static $inline_editable = false;

    private static $db = [
        'ColumnCount' => 'Int',
    ];

    private static $has_many = [
        'Rows' => Table\Row::class,
    ];

    private static $cascade_deletes = [
        'Rows',
    ];

    private static $cascade_duplicates = [
        'Rows',
    ];

    private static $field_labels = [
        'ColumnCount' => 'Počet stĺpcov',
        'Rows' => 'Riadky tabuľky',
    ];

    public function onBeforeWrite()
    {
        parent::onBeforeWrite();

        if ($this->isChanged('ColumnCount')) {
            $tableColumnCount = $this->ColumnCount;

            foreach ($this->Rows() as $row) {
                $columns = $row->Columns();

                if ($tableColumnCount > $columns->count()) {
                    $columnCountToAdd = $tableColumnCount - $columns->count();

                    for ($i = 0; $i < $columnCountToAdd; $i++) {
                        $columns->add(Table\Column::create());
                    }
                } elseif ($tableColumnCount < $columns->count()) {
                    $columnCountToRemove = $columns->count() - $tableColumnCount;

                    foreach ($columns->sort('ID DESC')->limit($columnCountToRemove) as $column) {
                        $column->delete();
                    }
                }
            }
        }
    }

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->removeByName('TableID');

            if ($rowsGF = $fields->dataFieldByName('Rows')) {
                $fields->removeByName('Rows');

                if ($this->ColumnCount) {
                    $rowsGFConfig = $rowsGF->getConfig();

                    $rowsGFConfig->getComponentByType(GridFieldDeleteAction::class)
                        ->setRemoveRelation(false);

                    $rowsGFDataColumns = $rowsGFConfig
                        ->getComponentByType(GridFieldDataColumns::class);

                    $fieldsToDisplay = [];
                    $customDataFields = [];

                    for ($i = 0; $i < $this->ColumnCount; $i++) {
                        $name = "[Relations][Columns][$i][Content]";

                        $fieldsToDisplay[$name] = [
                            'title' => 'Stĺpec ' . ($i+1),
                            'field' => TextField::class,
                        ];

                        $customDataFields[$name] = fn($record) => $record->Columns()[$i]?->Content;
                    }

                    $rowsGF->addDataFields($customDataFields);

                    $rowsGFConfig
                        ->removeComponentsByType(GridFieldAddNewButton::class)
                        ->removeComponentsByType(GridFieldAddExistingAutocompleter::class)
                        ->removeComponentsByType(GridFieldFilterHeader::class)
                        ->addComponent(GridFieldOrderableRows::create('Sort'))
                        ->addComponent(
                            GridFieldEditableColumns::create()
                                ->setDisplayFields($fieldsToDisplay),
                            GridFieldDataColumns::class,
                        )
                        ->removeComponent($rowsGFDataColumns)
                        ->addComponent(GridFieldAddNewInlineButton::create())
                    ;

                    $fields->addFieldToTab('Root.Main', $rowsGF);
                }
            }
        });

        return parent::getCMSFields();
    }

    public function getType()
    {
        return 'Tabuľka';
    }
}
