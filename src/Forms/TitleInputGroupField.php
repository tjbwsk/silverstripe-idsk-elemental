<?php

namespace TJBW\IdSkElemental\Forms;

use DNADesign\Elemental\Forms\TextCheckboxGroupField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextField;

class TitleInputGroupField extends CompositeField
{
    public function __construct($titleTagField = null, $titleClassField = null, $displayShowTitleField = true, $title = null)
    {
        if (!$title) {
            $title = _t(TextCheckboxGroupField::class . '.Title', 'Title');
        }

        $fields = [];

        if ($titleTagField) {
            $fields[] = $titleTagField;
        }

        $fields[] = TextField::create('Title', $title);

        if ($titleClassField) {
            $fields[] = $titleClassField;
        }

        if ($displayShowTitleField) {
            $fields[] = CheckboxField::create('ShowTitle', _t(TextCheckboxGroupField::class . '.ShowTitleLabel', 'Displayed'));
        }

        parent::__construct($fields);

        $this->setTitle($title);
    }

    public function performReadonlyTransformation()
    {
        $field = $this;

        if (!$this->readonly) {
            $field = parent::performReadonlyTransformation();

            $field->setTemplate(CompositeField::class);
            $field->setTitle($this->Title());

            if ($titleTagField = $field->fieldByName('TitleTag')) {
                $field->replaceField('TitleTag', LiteralField::create(
                    'TitleTag',
                    '<strong>' . $titleTagField->Value() . '</strong>',
                ));
            }

            if ($titleField = $field->fieldByName('Title')) {
                $field->replaceField('Title', LiteralField::create(
                    'Title',
                    $titleField->Value(),
                ));
            }

            if ($titleClassField = $field->fieldByName('TitleClass')) {
                $field->replaceField('TitleClass', LiteralField::create(
                    'TitleClass',
                    '<em>' . $titleClassField->Title() . '</em> <strong>' . $titleClassField->Value() . '</strong>',
                ));
            }

            if ($showTitle = $field->fieldByName('ShowTitle')) {
                $value = $showTitle->dataValue();
                $displayedText = _t(TextCheckboxGroupField::class . '.DISPLAYED', 'Displayed');
                $notDisplayedText = _t(TextCheckboxGroupField::class . '.NOT_DISPLAYED', 'Not displayed');

                $field->replaceField('ShowTitle', LiteralField::create(
                    'ShowTitle',
                    '<span class="badge ' . ($value ? 'badge-primary' : 'badge-danger') . '">' . ($value ? $displayedText : $notDisplayedText) . '</span>',
                ));
            }
        }

        return $field;
    }
}
