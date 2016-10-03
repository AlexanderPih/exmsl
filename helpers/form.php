<?php


namespace exmsl;


class Form {

    private $data;
    public $paragraph = 'p';

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * @param $html Surrounds html with paragraph p
     * @return string
     */
    protected function surround($html)
    {
        return "<{$this->paragrah}>{$html}</{$this->paragraph}>";
    }

    /**
     * Gets submited info if available
     * @param $index
     * @return mixed
     */
    protected function getValue($index)
    {
        if(is_object($this->data))
        {
            return $this->data->$index;
        }
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }

    /**
     * @param $label
     * @return string
     */
    public function label($label)
    {
        return '<label>' . $label . '</label>';
    }

    /**
     * simple input form
     * @param $type
     * @param array name, placeholder, id
     * @return string
     */
    public function input($type, $options = [])
    {
        $name = isset($options['name']) ? $options['name'] : '';
        $placeholder = isset($options['placeholder']) ? $options['placeholder'] : '';
        $id = isset($options['id']) ? $options['id'] : '';

        if($type == 'textarea')
        {
            return '<textarea name="' . $name . '" value="' . $this->getValue($name) . '" placeholder="' . $placeholder . '" required></textarea>';

        } else {

            return '<input type="' . $type . '" name="' . $name . '" id="' . $id . '" value="' . $this->getValue($name) . '" required>';

        }
    }

    /**
     * @param $label
     * @param $name
     * @return string
     */
    public function submit($label, $name)
    {
        return '<input type="submit" name="' . $name . '" value="' . $label . '">';
    }
} 