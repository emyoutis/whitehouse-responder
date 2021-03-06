<?php
/**
 * Created by PhpStorm.
 * User: emitis
 * Date: 5/25/19
 * Time: 12:37 AM
 */

namespace Emyoutis\WhiteHouseResponder;


class Replacer
{
    /**
     * @var string
     */
    private $template;

    /**
     * @var array
     */
    private $replaces;



    /**
     * Replacer constructor.
     *
     * @param string $template
     * @param array  $replaces
     */
    public function __construct(string $template, array $replaces)
    {
        $this->template = $template;
        $this->replaces = $replaces;
    }



    /**
     * Returns the result of the replace process.
     *
     * @return string
     */
    public function getResult()
    {
        $template = $this->template;

        foreach ($this->replaces as $search => $replacement) {
            $template = str_replace(':' . $search, $replacement, $template);
        }

        return $template;
    }



    /**
     * Does the replace process in a simple and rapid way.
     *
     * @param string $template
     * @param array  $replaces
     *
     * @return string
     */
    public static function replace(string $template, array $replaces)
    {
        $obj = new static($template, $replaces);

        return $obj->getResult();
    }



    /**
     * Does the replace process in a simple and rapid way for more than one templates.
     *
     * @param array $templates
     * @param array $replaces
     *
     * @return array
     */
    public static function replaceArray(array $templates, array $replaces)
    {
        foreach ($templates as $key => $template) {
            $templates[$key] = static::replace($template, $replaces);
        }

        return $templates;
    }
}
