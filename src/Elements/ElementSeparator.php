<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\Elemental\Models\BaseElement;

class ElementSeparator extends BaseElement
{
    private static $table_name = 'ElementSeparator';

    private static $icon = 'font-icon-minus';

    private static $singular_name = 'Oddeľovač';
    private static $plural_name = 'Oddeľovače';
    private static $description = 'Oddeľovač použite vtedy, keď chcete vizuálne oddeliť jednotlivé časti obsahu na stránke.';

    private static $displays_title_caption_field = false;
    private static $displays_title_in_template = false;
    private static $search_indexable = false;

    private static $field_labels = [
        'Title' => 'Interný názov',
    ];

    public function getType()
    {
        return 'Oddeľovač';
    }
}
