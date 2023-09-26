<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Blog\Model\BlogPost;

if (!class_exists(BlogPost::class)) {
    return;
}

class ElementBlogPostSummary extends BaseElement
{
    private static $table_name = 'ElementBlogPostSummary';

    private static $icon = 'font-icon-block-content';

    private static $singular_name = 'Vlastné zhrnutie príspevku';
    private static $plural_name = 'Vlastné zhrnutie príspevkov';
    private static $description = 'Vlastné zhrnutie príspevku.';

    private static $displays_title_caption_field = false;
    private static $displays_title_tag_field = false;
    private static $displays_title_class_field = false;
    private static $displays_title_in_template = false;
    private static $search_indexable = false;

    private static $field_labels = [
        'Title' => 'Interný názov',
    ];

    public function getType()
    {
        return 'Vlastné zhrnutie príspevku';
    }
}
