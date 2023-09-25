<?php

namespace TJBW\IdSkElemental\Extensions;

use SilverStripe\ORM\ArrayList;
use WeDevelop\ElementalGrid\Extensions\ElementalAreaExtension as VendorElementalAreaExtension;
use WeDevelop\ElementalGrid\Models\ElementRow;

if (!class_exists(VendorElementalAreaExtension::class)) {
    return;
}

class ElementalAreaExtension extends VendorElementalAreaExtension
{
    public function ElementControllersWithRows(): ?ArrayList
    {
        if ($controllers = parent::ElementControllersWithRows()) {
            if (($firstElement = $controllers->first()->getElement()) instanceof ElementRow && !$firstElement->ID) {
                $firstElement->ParentID = $this->owner->ID;
            }
        }

        return $controllers;
    }
}
