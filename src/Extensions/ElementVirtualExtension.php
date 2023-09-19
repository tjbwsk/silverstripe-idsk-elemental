<?php

namespace TJBW\IdSkElemental\Extensions;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class ElementVirtualExtension extends DataExtension
{
    public function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName('Title');

        if ($linkedElementField = $fields->dataFieldByName('LinkedElementID')) {
            $onlyClasses = [];

            if (SiteTree::get()->filter('FooterElementalAreaID', $this->owner->ParentID)->first()) {
                $onlyClasses = SiteTree::config()->get('allowed_footer_types');
            } elseif ($page = $this->owner->getPage()) {
                $onlyClasses = array_keys($page->getElementalTypes());
            }

            if ($onlyClasses) {
                $linkedElementField->setSource($linkedElementField->getSourceList()->filter('ClassName', $onlyClasses));
            }
        }
    }
}
