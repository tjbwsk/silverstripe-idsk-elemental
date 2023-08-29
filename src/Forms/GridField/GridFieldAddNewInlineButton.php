<?php

namespace TJBW\IdSkElemental\Forms\GridField;

use Exception;
use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPResponse_Exception;
use SilverStripe\Core\Convert;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridField_URLHandler;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataObjectInterface;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\View\ArrayData;
use SilverStripe\View\Requirements;
use Symbiote\GridFieldExtensions\GridFieldAddNewInlineButton as VendorGridFieldAddNewInlineButton;
use Symbiote\GridFieldExtensions\GridFieldEditableColumns;
use Symbiote\GridFieldExtensions\GridFieldExtensions;

/**
 * Builds on the {@link GridFieldEditableColumns} component to allow creating new records.
 */
class GridFieldAddNewInlineButton extends VendorGridFieldAddNewInlineButton implements GridField_URLHandler
{
    private static $allowed_actions = array(
        'handleForm'
    );

    public function getHTMLFragments($grid)
    {
        if ($grid->getList() && !singleton($grid->getModelClass())->canCreate()) {
            return array();
        }

        $fragment = $this->getFragment();

        /** @var GridFieldEditableColumns $editable */
        $editable = $grid->getConfig()->getComponentByType(GridFieldEditableColumns::class);
        if (!$editable) {
            throw new Exception('Inline adding requires the editable columns component');
        }

        Requirements::javascript('symbiote/silverstripe-gridfieldextensions:javascript/tmpl.js');
        GridFieldExtensions::include_requirements();

        $data = ArrayData::create(array(
            'Title'  => $this->getTitle(),
        ));

        return array(
            $fragment => $data->renderWith(parent::class),
            'after'   => $this->getRowTemplate($grid, $editable)
        );
    }

    private function getRowTemplate(GridField $grid, GridFieldEditableColumns $editable)
    {
        $columns = ArrayList::create();
        $handled = array_keys($editable->getDisplayFields($grid) ?? []);

        if ($grid->getList()) {
            $record = Injector::inst()->create($grid->getModelClass());
        } else {
            $record = null;
        }

        $fields = $this->getForm($grid, $record, '{%=o.num%}')->Fields();
        // $fields = $editable->getFields($grid, $record);

        foreach ($grid->getColumns() as $column) {
            if (in_array($column, $handled ?? [])) {
                $field = $fields->dataFieldByName($column);
                $field->setName(sprintf(
                    '%s[%s][{%%=o.num%%}][%s]',
                    $grid->getName(),
                    self::POST_KEY,
                    $field->getName()
                ));

                if ($record && $record->hasField($column)) {
                    $field->setValue($record->getField($column));
                }
                $content = $field->Field();
            } else {
                $content = $grid->getColumnContent($record, $column);

                // Convert GridFieldEditableColumns to the template format
                $content = str_replace(
                    sprintf('[%s][0]', GridFieldEditableColumns::POST_KEY),
                    sprintf('[%s][{%%=o.num%%}]', self::POST_KEY),
                    $content ?? ''
                );
            }

            // Cast content
            if (! $content instanceof DBField) {
                $content = DBField::create_field('HTMLFragment', $content);
            }

            $attrs = '';

            foreach ($grid->getColumnAttributes($record, $column) as $attr => $val) {
                $attrs .= sprintf(' %s="%s"', $attr, Convert::raw2att($val));
            }

            $columns->push(ArrayData::create(array(
                'Content'    => $content,
                'Attributes' => DBField::create_field('HTMLFragment', $attrs),
                'IsActions'  => $column == 'Actions'
            )));
        }

        return $columns->renderWith('Symbiote\\GridFieldExtensions\\GridFieldAddNewInlineRow');
    }

    public function getURLHandlers($grid)
    {
        return array(
            'new/form/$ID' => 'handleForm'
        );
    }

    public function handleForm(GridField $grid, $request)
    {
        $id = $request->param('ID');

        if (!ctype_digit($id)) {
            throw new HTTPResponse_Exception(null, 400);
        }

        if ($grid->getList()) {
            $record = Injector::inst()->create($grid->getModelClass());
        } else {
            $record = null;
        }

        $form = $this->getForm($grid, $record, $id);

        foreach ($form->Fields() as $field) {
            $field->setName($this->getFieldName($field->getName(), $grid, $id));
        }

        return $form;
    }

    public function getForm(GridField $grid, DataObjectInterface $record, string $recordId)
    {
        $editable = $grid->getConfig()->getComponentByType(GridFieldEditableColumns::class);

        $form = $editable->getForm($grid, $record);

        $form->setFormAction(Controller::join_links(
            $grid->Link(),
            'new/form',
            $recordId,
        ));

        return $form;
    }

    protected function getFieldName($name, GridField $grid, int $recordId)
    {
        return sprintf(
            '%s[%s][%s][%s]',
            $grid->getName(),
            self::POST_KEY,
            $recordId,
            $name
        );
    }
}
