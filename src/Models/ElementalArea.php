<?php

namespace TJBW\IdSkElemental\Models;

use DNADesign\Elemental\Models\ElementalArea as VendorElementalArea;
use DNADesign\ElementalVirtual\Model\ElementVirtual;
use SilverStripe\ORM\ArrayList;
use TJBW\IdSkElemental\Elements\ElementPhaseBanner;

class ElementalArea extends VendorElementalArea
{
    public function ElementControllers()
    {
        $controllers = parent::ElementControllers();

        $this->unsetFirstPhaseBanner($controllers);

        return $controllers;
    }

    public function ElementControllersWithRows(): ?ArrayList
    {
        if ($controllers = parent::ElementControllersWithRows()) {
            $this->unsetFirstPhaseBanner($controllers, 1);
        }

        return $controllers;
    }

    public function unsetFirstPhaseBanner($controllers, $index = 0)
    {
        if (
            ($firstElement = ($firstController = $controllers[$index] ?? null) ? $firstController->getElement() : null)
            && (
                $firstElement instanceof ElementPhaseBanner
                || (
                    class_exists(ElementVirtual::class)
                    && $firstElement instanceof ElementVirtual
                    && $firstElement->LinkedElement() instanceof ElementPhaseBanner
                )
            )
        ) {
            $controllers->offsetUnset($index);
        }
    }

    public function forTemplate()
    {
        return $this->renderWith(VendorElementalArea::class);
    }
}
