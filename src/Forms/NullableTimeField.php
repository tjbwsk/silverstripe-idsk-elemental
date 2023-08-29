<?php

namespace TJBW\IdSkElemental\Forms;

use SilverStripe\Forms\TimeField;

class NullableTimeField extends TimeField
{
    public function Value()
    {
        $localised = $this->internalToFrontend($this->value);
        if ($localised) {
            return $localised;
        }

        return null;
    }
}
