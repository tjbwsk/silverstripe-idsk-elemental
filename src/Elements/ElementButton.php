<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\Elemental\Models\BaseElement;
use TJBW\IdSkElemental\Extensions\ElementVariation;

/**
 * @see https://idsk.gov.sk/komponenty/tlacidla
 */
class ElementButton extends BaseElement
{
    private static $extensions = [
        ElementVariation::class,
    ];

    private static $table_name = 'ElementButton';

    private static $icon = 'font-icon-block-link';

    private static $singular_name = 'Tlačidlo';
    private static $plural_name = 'Tlačidlá';
    private static $description = 'Zobrazuje tlačidlo s odkazom.';

    private static $displays_title_caption_field = false;
    private static $displays_title_in_template = false;

    private static $db = [
        // TODO: RedirectionType (\SilverStripe\CMS\Model\RedirectorPage)
        'URL' => 'Varchar(2083)',
        'TargetBlank' => 'Boolean',
        'StartButton' => 'Boolean',
    ];

    private static $field_labels = [
        'URL' => 'Odkaz',
        'TargetBlank' => 'Otvoriť odkaz v novom okne',
        'StartButton' => 'Spúšťacie tlačidlo (so šípkou)',
    ];

    private static $variants = [
        'idsk-button--secondary' => 'Sekundárne (sivé)',
        'idsk-button--warning' => 'Výstražné (červené)',
    ];

    public function getType()
    {
        return 'Tlačidlo';
    }
}
