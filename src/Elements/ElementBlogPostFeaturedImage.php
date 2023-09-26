<?php

namespace TJBW\IdSkElemental\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Blog\Model\BlogPost;

if (!class_exists(BlogPost::class)) {
    return;
}

class ElementBlogPostFeaturedImage extends BaseElement
{
    private static $table_name = 'ElementBlogPostFeaturedImage';

    private static $icon = 'font-icon-block-file';

    private static $singular_name = 'Hlavný obrázok príspevku';
    private static $plural_name = 'Hlavný obrázok príspevkov';
    private static $description = 'Hlavný obrázok príspevku.';

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
        return 'Hlavný obrázok príspevku';
    }
}
