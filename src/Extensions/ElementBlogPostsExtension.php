<?php

namespace TJBW\IdSkElemental\Extensions;

use SilverStripe\ORM\DataExtension;

class ElementBlogPostsExtension extends DataExtension
{
    private static $db = [
        'ShowBlogTitleInPosts' => 'Boolean',
    ];

    private static $field_labels = [
        'ShowBlogTitleInPosts' => 'Zobrazovať názov blogu v príspevkoch',
    ];
}
