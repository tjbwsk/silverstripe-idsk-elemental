<?php

namespace TJBW\IdSkElemental\Extensions;

use SilverStripe\ORM\DataExtension;
use TractorCow\Fluent\Model\Locale;

class SiteTreeFluentExtension extends DataExtension
{
    private static $field_include = [
        'ElementalAreaID',
        'FooterElementalAreaID',
    ];

    public function onBeforeWrite()
    {
        if (!$this->owner->isDraftedInLocale() && $this->owner->isInDB()) {
            $elementalArea = $this->owner->ElementalArea();
            $elementalAreaNew = $elementalArea->duplicate();
            $this->owner->ElementalAreaID = $elementalAreaNew->ID;

            $footerElementalArea = $this->owner->FooterElementalArea();
            $footerElementalAreaNew = $footerElementalArea->duplicate();
            $this->owner->FooterElementalAreaID = $footerElementalAreaNew->ID;
        }

        return;
    }

    public function updateLocaliseSelect(&$query, $table, $field, Locale $locale)
    {
        // disallow elemental data inheritance in the case that published localised page instance already exists
        if (in_array($field, ['ElementalAreaID', 'FooterElementalAreaID']) && $this->owner->isPublishedInLocale()) {
            $query = '"' . $table . '_Localised_' . $locale->getLocale() . '"."' . $field . '"';
        }
    }
}
