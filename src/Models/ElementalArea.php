<?php

namespace TJBW\IdSkElemental\Models;

use DNADesign\Elemental\Models\ElementalArea as VendorElementalArea;
use DNADesign\ElementalVirtual\Model\ElementVirtual;
use TJBW\IdSkElemental\Elements\ElementPhaseBanner;

class ElementalArea extends VendorElementalArea
{
    public function ElementControllers()
    {
        $controllers = parent::ElementControllers();

        if (
            ($firstElement = ($firstController = $controllers[0] ?? null) ? $firstController->getElement() : null)
            && (
                $firstElement instanceof ElementPhaseBanner
                || (
                    class_exists(ElementVirtual::class)
                    && $firstElement instanceof ElementVirtual
                    && $firstElement->LinkedElement() instanceof ElementPhaseBanner
                )
            )
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
