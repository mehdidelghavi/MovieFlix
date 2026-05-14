<?php
namespace App\Services;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;


class SeoService
{
    public static function set(
        string $title,
        string $description,
        ?string $image = null
    ): void {

        $url = url()->current();

        // Basic SEO
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical($url);

        // OpenGraph
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl($url);
        OpenGraph::setSiteName(config('app.name'));
        OpenGraph::addProperty('type', 'website');

        // Twitter Card
        SEOMeta::addMeta('twitter:card', 'summary_large_image');
        SEOMeta::addMeta('twitter:title', $title);
        SEOMeta::addMeta('twitter:description', $description);

        // Image
        if ($image) {

            $image = asset($image);

            OpenGraph::addImage($image);

            SEOMeta::addMeta('twitter:image', $image);

            JsonLd::addImage($image);
        }

        // JSON-LD
        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setType('WebPage');
    }
}