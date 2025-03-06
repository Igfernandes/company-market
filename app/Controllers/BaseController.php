<?php

namespace App\Controllers;

use App\Database\Entities\Users\GroupsEntity;
use App\Database\Mappers\Users\GroupsMapper;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Defines whether user authentication is required or not
     *
     * @var boolean
     */
    protected $authentication = false;


    /**
     * Object of main configs
     *
     * @var array
     */
    protected $configs = [];

    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $session = session();
        $user = $session->get('author');

        if ($this->authentication === true) {
            if (empty($user))
                return redirect()->to(ROUTE_LOGOUT);

            $groupsMapper = new GroupsMapper();

            $this->configs = [
                "title" => "Sport Plataform",
                "hasAuthentication" => true,
                "user" => [
                    "name" => $user->name,
                    "photo" => $user->photo
                ],
                "tab" => "index",
                "status" => $user->status,
                "response" => $session->get('response'),
                "type" => $session->get('type'),
                "usersGroups" => array_map(fn (GroupsEntity $groups) => $groups->getTitle(), $groupsMapper->mapper()),
                "companiesGroups" => [ucfirst(lang('Words.clubs')), ucfirst(lang('Words.federations'))]
            ];
        }
        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
}
