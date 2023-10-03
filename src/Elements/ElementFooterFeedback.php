<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\ElementalUserForms\Model\ElementForm;
use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;
use Rasstislav\IdSk\TinyMCEConfig;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Tab;

if (!class_exists(ElementForm::class)) {
    return;
}

/**
 * @see https://idsk.gov.sk/komponenty/footer-extended#ukazka-zakladna-paticka-feedback
 */
class ElementFooterFeedback extends ElementForm
{
    private static $table_name = 'ElementFooterFeedback';

    private static $icon = 'font-icon-white-question';

    private static $singular_name = 'Spätná väzba';
    private static $plural_name = 'Spätná väzba';
    private static $description = 'Spätná väzba vám pomôže zistiť či obsah, ktorý publikujete, je užitočný pre používateľa.';

    private static $displays_title_caption_field = false;
    private static $displays_title_tag_field = false;
    private static $displays_title_class_field = false;
    private static $displays_title_in_template = false;
    private static $displays_remove_component_bottom_margin_field = false;
    private static $search_indexable = false;

    private static $db = [
        'FeedbackTitle' => 'Varchar(255)',
        'FeedbackContent' => 'HTMLText',
        'SurveyTitle' => 'Varchar(255)',
        'SurveyContent' => 'HTMLText',
    ];

    private static $has_one = [
        'SurveyAction' => Link::class,
    ];

    private static $cascade_deletes = [
        'SurveyAction',
    ];

    private static $cascade_duplicates = [
        'SurveyAction',
    ];

    private static $field_labels = [
        'Title' => 'Interný názov',
        'Content' => 'Obsah',
        'FeedbackTitle' => 'Nadpis',
        'FeedbackContent' => 'Obsah',
        'SurveyTitle' => 'Nadpis',
        'SurveyContent' => 'Obsah',
        'SurveyAction' => 'Odkaz',
    ];

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->dataFieldByName('FeedbackContent')->setRows(5);
            $fields->dataFieldByName('SurveyContent')->setRows(5);

            $fields->replaceField('SurveyActionID',
                LinkField::create(
                    'SurveyAction',
                    $this->fieldLabel('SurveyAction'),
                    $this,
                    [
                        'types' => [
                            'SiteTree',
                        ],
                    ],
                )
            );

            $fields->insertAfter('Main', Tab::create('Feedback', 'Spätná väzba'));
            $fields->insertAfter('Feedback', Tab::create('Survey', 'Prieskum spokojnosti'));

            $fields->addFieldsToTab('Root.Feedback', [
                $fields->dataFieldByName('FeedbackTitle'),
                $fields->dataFieldByName('FeedbackContent'),
            ]);

            $fields->addFieldsToTab('Root.Survey', [
                $fields->dataFieldByName('SurveyTitle'),
                $fields->dataFieldByName('SurveyContent'),
                $fields->dataFieldByName('SurveyAction'),
            ]);

            TinyMCEConfig::get('cms')
                ->setMode($fields->dataFieldByName('OnCompleteMessage'), TinyMCEConfig::MODE_MINIMAL)
                ->removeRootBlock();
        });

        return parent::getCMSFields();
    }

    public function getType()
    {
        return 'Spätná väzba';
    }
}
