<?php

namespace App\Enums;

enum PostType: string
{
    case ARTICLE = 'article';
    case NEWS = 'news';
    case PAGE = 'page';
    case PRODUCT = 'product';
    case TECHNOLOGY = 'technology';
}
