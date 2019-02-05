<?php

namespace toTwig\Converter;

use toTwig\ConverterAbstract;

/**
 * Class OxinputhelpConverter
 *
 * @author Tomasz Kowalewski (t.kowalewski@createit.pl)
 */
class OxinputhelpConverter extends ConverterAbstract
{

    protected $name = 'oxinputhelp';
    protected $description = "Convert smarty {oxinputhelp} to twig include with specified file path and parameters";
    protected $priority = 100;

    /**
     * @param \SplFileInfo $file
     * @param string $content
     * @return mixed|string
     */
    public function convert(\SplFileInfo $file, string $content): string
    {
        $return = $this->replace($content);
        return $return;
    }

    /**
     * @param $content
     * @return null|string|string[]
     */
    private function replace(string $content): string
    {
        $pattern = $this->getOpeningTagPattern('oxinputhelp');
        return preg_replace_callback($pattern, function($matches) {

            $match = $matches[1];
            $attr = $this->attributes($match);
            if(isset($attr['ident'])) {
                $attr['ident'] = $this->value($attr['ident']);
            }

            $string = '{% include "inputhelp.html.twig" with {\'sHelpId\': help_id(:ident), \'sHelpText\': help_text(:ident)} %}';

            $string = $this->vsprintf($string, $attr);
            // Replace more than one space to single space
            $string = preg_replace('!\s+!', ' ', $string);

            return str_replace($matches[0], $string, $matches[0]);

        }, $content);

    }

}
