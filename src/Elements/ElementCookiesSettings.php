<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\View\Requirements;

/**
 * @see https://idsk.gov.sk/vzory/stranka-o-cookies#nastavenie-cookies-pouzivatelom
 */
class ElementCookiesSettings extends BaseElement
{
    private static $table_name = 'ElementCookiesSettings';

    private static $icon = 'font-icon-block-settings-2';

    private static $singular_name = 'Nastavenia cookies';
    private static $plural_name = 'Nastavenia cookies';
    private static $description = 'Povolenie alebo zakázanie nastavovania cookies samotným používateľom na cookies stránke.';

    // TODO: add no-js support

    public function forTemplate($holder = true)
    {
        Requirements::javascript('tjbw/silverstripe-idsk-elemental: client/dist/javascript/cookies/settings.js');

        return parent::forTemplate($holder);
    }

    public function getType()
    {
        return 'Nastavenia cookies';
    }
}
