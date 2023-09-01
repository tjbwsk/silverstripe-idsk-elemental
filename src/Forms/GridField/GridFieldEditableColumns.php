<?php

namespace TJBW\IdSkElemental\Forms\GridField;

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataObjectInterface;
use Symbiote\GridFieldExtensions\GridFieldEditableColumns as VendorGridFieldEditableColumns;

class GridFieldEditableColumns extends VendorGridFieldEditableColumns
{
    public function handleSave(GridField $grid, DataObjectInterface $record)
    {
        parent::handleSave($grid, $record);

        /** @var DataList $list */
        $list  = $grid->getList();
        $value = $grid->Value();

        if (!isset($value[self::POST_KEY]) || !is_array($value[self::POST_KEY])) {
            return;
        }

        // Fetch the items before processing them
        $ids = array_keys($value[self::POST_KEY]);
        if (empty($ids)) {
            return;
        }
        $itemsCollection = ArrayList::create($list->filter('ID', $ids)->toArray());

        foreach ($value[self::POST_KEY] as $id => $fields) {
            if ($relations = $fields['Relations'] ?? null) {
                if (!is_numeric($id) || !is_array($fields)) {
                    continue;
                }

                // Find the item from the fetched collection of items
                $item = $itemsCollection->find('ID', $id);

                // Skip not found item, or don't have any changed fields, or current user can't edit
                if (!$item || !$item->canEdit()) {
                    continue;
                }

                foreach ($relations as $relation => $data) {
                    $relationList = $item->$relation();

                    foreach ($data as $index => $fields) {
                        $relationItem = $relationList[$index];

                        foreach ($fields as $field => $value) {
                            $relationItem->$field = $value;
                        }

                        $relationItem->write();
                    }
                }
            }
        }
    }

    protected function getFieldName($name, GridField $grid, DataObjectInterface $record)
    {
        if (!str_starts_with($name, '[Relations]')) {
            $name = "[$name]";
        }

        return sprintf(
            '%s[%s][%s]%s',
            $grid->getName(),
            self::POST_KEY,
            $record->ID,
            $name
        );
    }
}
