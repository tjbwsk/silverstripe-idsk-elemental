<?php

namespace TJBW\IdSkElemental\Extensions;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use TractorCow\Fluent\State\FluentState;

class ElementVirtualExtension extends DataExtension
{
    public function updateContentForSearchIndex(&$content): void
    {
        if (!$this->owner->LinkedElement()->getSearchIndexable()) {
            $content = '';
        }
    }

    public function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName('Title');

        if ($linkedElementField = $fields->dataFieldByName('LinkedElementID')) {
            $onlyClasses = [];

            if (SiteTree::get()->filter('HeaderElementalAreaID', $this->owner->ParentID)->first()) {
                $onlyClasses = SiteTree::config()->get('allowed_header_types');
            } elseif (SiteTree::get()->filter('FooterElementalAreaID', $this->owner->ParentID)->first()) {
                $onlyClasses = SiteTree::config()->get('allowed_footer_types');
            } elseif ($page = $this->owner->getPage()) {
                $onlyClasses = array_keys($page->getElementalTypes());
            }

            $filter = [];

            if (class_exists(FluentState::class)) {
                $filter['TopPageLocale'] = FluentState::singleton()->getLocale();
            }

            if ($onlyClasses) {
                $filter['ClassName'] = $onlyClasses;
            }

            if ($filter) {
                $linkedElementField->setSource($linkedElementField->getSourceList()->filter($filter));
            }
        }
    }
}
