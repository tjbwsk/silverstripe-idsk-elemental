<?php

namespace TJBW\IdSkElemental\Models;

use DNADesign\Elemental\Models\ElementalArea as VendorElementalArea;
use TJBW\IdSkElemental\Elements\ElementPhaseBanner;

class ElementalArea extends VendorElementalArea
{
    public function ElementControllers()
    {
        $controllers = parent::ElementControllers();

        if (
            ($firstElement = ($firstController = $controllers[0] ?? null) ? $firstController->getElement() : null)
            && $firstElement instanceof ElementPhaseBanner
        ) {
            $controllers->offsetUnset(0);
        }

        return $controllers;
    }

    public function forTemplate()
    {
        return $this->renderWith(VendorElementalArea::class);
    }
}
