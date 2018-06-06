<?php declare(strict_types=1);

/**
 * @license Apache 2.0
 */

namespace Swagger\Annotations;

use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation
 * @Target({"CLASS", "ANNOTATION", "PROPERTY"})
 * A "Response Object": https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.0.md#response-object
 *
 * Describes a single response from an API Operation, including design-time, static links to operations based on the response.
 */
class Response extends AbstractAnnotation
{
    /**
     * $ref See http://json-schema.org/latest/json-schema-core.html#rfc.section.7
     * @var string
     */
    public $ref;

    /**
     * The key into Operations->responses array.
     *
     * @var string a HTTP Status Code or "default"
     */
    public $response;

    /**
     * A short description of the response.
     * CommonMark syntax may be used for rich text representation.
     *
     * @var string
     */
    public $description;

    /**
     * Maps a header name to its definition.
     * RFC7230 states header names are case insensitive. https://tools.ietf.org/html/rfc7230#page-22
     * If a response header is defined with the name "Content-Type", it shall be ignored.
     *
     * @var Header[]
     */
    public $headers;

    /**
     * A map containing descriptions of potential response payloads.
     * The key is a media type or media type range and the value describes it.
     * For responses that match multiple keys, only the most specific key is applicable. e.g. text/plain overrides text/*
     *
     * @var MediaType[]
     */
    public $content;

    /**
     * A map of operations links that can be followed from the response.
     * The key of the map is a short name for the link, following the naming constraints of the names for Component Objects.
     *
     * @var array
     */
    public $links;

    /** @inheritdoc */
    public static $_required = ['description'];

    /** @inheritdoc */
    public static $_types = [
        'description' => 'string',
    ];

    /** @inheritdoc */
    public static $_nested = [
        'Swagger\Annotations\MediaType' => ['content', 'mediaType'],
        'Swagger\Annotations\Header' => ['headers', 'header'],
        'Swagger\Annotations\Link' => ['links', 'link'],
    ];

    /** @inheritdoc */
    public static $_parents = [
        'Swagger\Annotations\Components',
        'Swagger\Annotations\Operation',
        'Swagger\Annotations\Get',
        'Swagger\Annotations\Post',
        'Swagger\Annotations\Put',
        'Swagger\Annotations\Patch',
        'Swagger\Annotations\Delete',
        'Swagger\Annotations\Head',
        'Swagger\Annotations\Options',
        'Swagger\Annotations\Trace',
    ];
}
