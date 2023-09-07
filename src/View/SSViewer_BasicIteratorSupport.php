<?php

namespace TJBW\IdSkElemental\View;

use SilverStripe\View\SSViewer_BasicIteratorSupport as CoreSSViewer_BasicIteratorSupport;
use SilverStripe\View\TemplateIteratorProvider;

class SSViewer_BasicIteratorSupport extends CoreSSViewer_BasicIteratorSupport implements TemplateIteratorProvider
{
    public static function get_template_iterator_variables()
    {
        return [
            'IsMedian',
            'LoopPos' => ['method' => 'Pos'],
        ];
    }

    public function IsMedian()
    {
        return $this->iteratorPos === (int) round($this->iteratorTotalItems / 2, 0, PHP_ROUND_HALF_UP);
    }
}
