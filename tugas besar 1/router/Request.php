<?php
require_once dirname(__FILE__) . '/IRequest.php';

/**
 * @property  string requestMethod
 */
class Request implements IRequest
{
    function __construct()
    {
        $this->bootstrapSelf();
    }

    /**
     * Use the existing $_SERVER variable to create
     * dynamic members and assign it's key to this class
     * members
     */
    private function bootstrapSelf()
    {
        foreach($_SERVER as $key => $value)
        {
            $this->{$this->toCamelCase($key)} = $value;
        }
    }

    /**
     * Turn string into its camel case representative
     * @param $string string original string
     * @return mixed|string converted string
     */
    private function toCamelCase($string)
    {
        $result = strtolower($string);

        preg_match_all('/_[a-z]/', $result, $matches);
        foreach($matches[0] as $match)
        {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }
        return $result;
    }

    /**
     * Get the body of a request, if it's post
     * @return array|null
     */
    public function getBody()
    {
        if($this->requestMethod === "GET")
        {
            return null;
        }
        if ($this->requestMethod == "POST")
        {
            $result = array();
            foreach($_POST as $key => $value)
            {
                $result[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            return $result;
        }
    }
}