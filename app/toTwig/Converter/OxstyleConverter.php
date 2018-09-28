<?php

namespace toTwig\Converter;

use toTwig\AbstractSingleTagConverter;

/**
 * Class OxstyleConverter
 *
 * @author Tomasz Kowalewski (t.kowalewski@createit.pl)
 */
class OxstyleConverter extends AbstractSingleTagConverter
{

    protected $name = 'oxstyle';
    protected $description = "Convert smarty {oxstyle} to twig function {{ oxstyle() }}";
    protected $priority = 100;
}
