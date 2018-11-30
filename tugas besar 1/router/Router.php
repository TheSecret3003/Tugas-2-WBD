<?php /** @noinspection PhpUndefinedFieldInspection */
/**
 * Created by PhpStorm.
 * User: Gery Wahyu
 * Date: 10/15/2018
 * Time: 9:39 AM
 */

require_once dirname(__FILE__) . '/Request.php';
require_once dirname(__FILE__) . '/IRequest.php';

class Router
{
    private $request;
    private $supportedHttpMethods = array(
      "GET",
      "POST"
    );

    function __construct(IRequest $request)
    {
        $this->request = $request;
    }

    function __call($name, $arguments)
    {
        list($route, $method) = $arguments;
        if (!in_array(strtoupper($name), $this->supportedHttpMethods))
        {
            $this->invalidMethodHandler();
        }
        $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
    }

    /**
     * Removes trailing forward slashes from the right of the route.
     * @param string route
     * @return string
     */
    private function formatRoute($route)
    {
        $result = rtrim($route, '/');
        if ($result === '')
        {
            return '/';
        }
        return $result;
    }

    private function invalidMethodHandler()
    {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }

    private function defaultRequestHandler()
    {
        header("{$this->request->serverProtocol} 404 Not Found");
    }
    /**
     * Resolves a route
     */
    function resolve()
    {
        $methodDictionary = $this->{strtolower($this->request->requestMethod)};
        $route = $this->formatRoute($this->request->requestUri);
        $method = $methodDictionary[$route];
        if(is_null($method))
        {
            $this->defaultRequestHandler();
            return;
        }
        echo call_user_func_array($method, array($this->request));
    }
    function __destruct()
    {
        $this->resolve();
    }
}