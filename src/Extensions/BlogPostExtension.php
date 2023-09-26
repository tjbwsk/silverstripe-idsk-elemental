<?php

namespace TJBW\IdSkElemental\Extensions;

use Arillo\MultiSelectField\MultiSelectField;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormScaffolder;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\Tab;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Versioned\GridFieldArchiveAction;

class BlogPostExtension extends DataExtension
{
    private static $db = [
        'InPageNavigationTemplate' => 'Boolean(1)',
    ];

    private static $many_many = [
        'NavigationItems' => BaseElement::class,
    ];

    private static $field_labels = [
        'InPageNavigationTemplate' => 'Zobraziť navigáciu na stránke',
        'NavigationItems' => 'Navigácia',
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('ShowFeaturedImage');
        $fields->dataFieldByName('Summary')->setDescription(null);

        $fields->insertAfter('Main', Tab::create('NavigationItems', 'Navigácia'));

        $fields->addFieldToTab(
            'Root.NavigationItems',
            $this->owner->dbObject('InPageNavigationTemplate')->scaffoldFormField()
                ->setTitle($this->owner->fieldLabel('InPageNavigationTemplate'))
        );

        FormScaffolder::addManyManyRelationshipFields(
            $fields,
            'NavigationItems',
            null,
            true,
            $this->owner,
        );

        if ($navigationItems = $fields->dataFieldByName('NavigationItems')) {
            if (class_exists(MultiSelectField::class)) {
                if (($elements = $this->owner->ElementalArea()->Elements())->exists()) {
                    $fields->replaceField('NavigationItems',
                        MultiSelectField::create(
                            'NavigationItems',
                            $this->owner->fieldLabel('NavigationItems'),
                            $this->owner,
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
    }
}
