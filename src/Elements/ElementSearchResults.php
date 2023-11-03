<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Control\Controller;

/**
 * @see https://idsk.gov.sk/vzory/vzor-vysledky-vyhladavania
 */
class ElementSearchResults extends BaseElement
{
    private static $table_name = 'ElementSearchResults';

    private static $icon = 'font-icon-block-search';

    private static $singular_name = 'Výsledky vyhľadávania';
    private static $plural_name = 'Výsledky vyhľadávania';
    private static $description = 'Výsledky vyhľadávania.';

    private static $search_indexable = false;

    public function TopSearchForm()
    {
        return Controller::curr()->SearchForm()
            ->setName(__FUNCTION__)
            ->setTemplate('Rasstislav\\IdSk\\Forms\\'.__FUNCTION__);
    }

    public function SideSearchForm()
    {
        return Controller::curr()->SearchForm()
            ->setName(__FUNCTION__)
            ->setTemplate('Rasstislav\\IdSk\\Forms\\'.__FUNCTION__);
    }

    public function getResults()
    {
        return Controller::curr()->SearchForm()->getResults();
    }

    public function getType()
    {
        return 'Výsledky vyhľadávania';
    }
}
