<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Slim\Container;

class Controller{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var db
     */
    protected $db;

    /**
     * @var session
     */
    protected $session;

    /**
     * @var cookie
     */
    protected $cookie;

    /**
     * @var data
     */
    protected $data = [];

    /**
     * @var mailer
     */
    protected $mailer;

    /**
     * @param Container $container
     */
    public function __construct(Container $container){
        $this->container = $container;

        $this->db = $container->db;

        $this->session = $container->session;
        $this->cookie = $container->cookie;

        $this->mailer = $container->mailer;
    }

    /**
     * @param ResponseInterface $response
     * @param string $template
     * @param array $data
     */
    public function render(ResponseInterface $response,$template,$data = []){
        $d = [
            'session'   => $this->session,
            'environment' => $this->container["environment"]
        ];
        $data = array_merge($data, $d, $this->data);
        $this->container->view->render($response, $template, $data);
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name){
        return $this->container->get($name);
    }

    /**
     * clean all data by different filters
     * @param array $data
     *
     * @return array
     */
    protected function clean($data){
        $d = [];
        foreach ($data as $key => $value) {
            $d[$key] = is_array($value)? $this->clean($value) : $d[$key] = strip_tags(trim($value));
        }

        return $d;
    }
}
