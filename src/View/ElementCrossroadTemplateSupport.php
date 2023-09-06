<?php

namespace TJBW\IdSkElemental\View;

use SilverStripe\View\SSViewer_BasicIteratorSupport;
use SilverStripe\View\TemplateGlobalProvider;
use SilverStripe\View\TemplateIteratorProvider;

class ElementCrossroadTemplateSupport extends SSViewer_BasicIteratorSupport implements TemplateIteratorProvider, TemplateGlobalProvider
{
    public static function get_template_iterator_variables()
    {
        return [
            'CrossroadIsOneColumnItemHidden' => ['method' => 'IsOneColumnItemHidden'],
            'CrossroadIsTwoColumnItemHidden' => ['method' => 'IsTwoColumnItemHidden'],
        ];
    }

    public static function get_template_global_variables()
    {
        return [
            'CrossroadLowerThreshold' => ['method' => 'LowerThreshold'],
            'CrossroadUpperThreshold' => ['method' => 'UpperThreshold'],
        ];
    }

    public function IsOneColumnItemHidden()
    {
        return $this->iteratorPos >= static::LowerThreshold();
    }

    public function IsTwoColumnItemHidden()
    {
        if ($this->iteratorPos >= static::LowerThreshold()) {
            $fromEnd = (int) round(($this->iteratorTotalItems - static::UpperThreshold()) / 2, 0, PHP_ROUND_HALF_DOWN);

            if ($this->iteratorPos >= $this->iteratorTotalItems - $fromEnd) {
                return true;
            } elseif ($this->iteratorPos < (int) round($this->iteratorTotalItems / 2, 0, PHP_ROUND_HALF_UP)) {
                return true;
            }
        }

        return false;
    }

    public static function LowerThreshold()
    {
        return 5;
    }

    public static function UpperThreshold()
    {
        return static::LowerThreshold() * 2;
    }
}
