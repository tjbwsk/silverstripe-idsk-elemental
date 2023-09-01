<?php

namespace TJBW\IdSkElemental\Models\Table;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField;
use SilverStripe\ORM\DataObject;
use Symbiote\GridFieldExtensions\GridFieldEditableColumns;
use TJBW\IdSkElemental\Elements\ElementTable;

class Row extends DataObject
{
    private static $table_name = 'TableRow';

    private static $singular_name = 'Riadok tabuľky';
    private static $plural_name = 'Riadky tabuľky';

    private static $db = [
        'Sort' => 'Int',
    ];

    private static $has_one = [
        'Table' => ElementTable::class,
    ];

    private static $has_many = [
        'Columns' => Column::class,
    ];

    private static $cascade_deletes = [
        'Columns',
    ];

    private static $cascade_duplicates = [
        'Columns',
    ];

    private static $field_labels = [
        'Table' => 'Tabuľka',
        'Columns' => 'Stĺpce',
    ];

    private static $default_sort = '"Sort" ASC';

    public function onBeforeWrite()
    {
        parent::onBeforeWrite();

        if (!$this->isInDB() && ($tableColumnCount = $this->Table()->ColumnCount)) {
            $columns = $this->Columns();

            $columnCountToAdd = $tableColumnCount - $columns->count();

            for ($i = 0; $i < $columnCountToAdd; $i++) {
                $columns->add(Column::create());
            }
        }
    }

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->removeByName('Sort');
            $fields->removeByName('TableID');

            if ($columnsGF = $fields->dataFieldByName('Columns')) {
                $fields->removeByName('Columns');

                $columnsGFConfig = $columnsGF->getConfig();

                $columnsGFConfig->getComponentByType(GridField\GridFieldDeleteAction::class)
                    ->setRemoveRelation(false);

                $columnsGFDataColumns = $columnsGFConfig
                    ->getComponentByType(GridField\GridFieldDataColumns::class);

                $columnsGFConfig
                    ->removeComponentsByType(GridField\GridFieldButtonRow::class)
                    ->removeComponentsByType(GridField\GridFieldAddNewButton::class)
                    ->removeComponentsByType(GridField\GridFieldAddExistingAutocompleter::class)
                    ->removeComponentsByType(GridField\GridFieldToolbarHeader::class)
                    ->removeComponentsByType(GridField\GridFieldSortableHeader::class)
                    ->removeComponentsByType(GridField\GridFieldFilterHeader::class)
                    ->removeComponentsByType(GridField\GridFieldPageCount::class)
                    ->removeComponentsByType(GridField\GridFieldPaginator::class)
                    ->addComponent(
                        GridFieldEditableColumns::create()
                            ->setDisplayFields([
                                'Content' => [
                                    'callback' => fn ($record, $column, $grid) => DataObject::singleton(Column::class)
                                        ->dbObject($column)->scaffoldFormField()
                                        ->setRows(3)
                                        ->setTitle(false),
                                ],
                            ]),
                        GridField\GridFieldDataColumns::class,
                    )
                    ->removeComponent($columnsGFDataColumns)
                ;

                $fields->addFieldToTab('Root.Main', $columnsGF);
            }
        });

        return parent::getCMSFields();
    }
}
