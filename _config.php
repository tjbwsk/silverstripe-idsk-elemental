<?php

use DNADesign\Elemental\Models\ElementContent;
use WeDevelop\ElementalGrid\Extensions\ElementContentExtension;

if (class_exists(ElementContentExtension::class)) {
    ElementContent::remove_extension(ElementContentExtension::class);
}
