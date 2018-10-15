<?php

namespace App\AuthBundle\Controllers;

use Core\Twig;
use Core\Controller;
use Core\Session\Session;
use App\AuthBundle\Entity\User;
use App\AuthBundle\Manager\UserManager;
use Psr\Http\Message\ServerRequestInterface as Request;

class SignupController extends Controller
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var UserManager
     */
    private $userManager;

    /**
     * @var Twig
     */
    private $twig;

    /**
     * SignupController constructor.
     * @param Session $session
     * @param UserManager $userManager
     * @param Twig $twig
     */
    public function __construct(
        Session $session,
        UserManager $userManager,
        Twig $twig
    ) {

        $this->session = $session;
        $this->userManager = $userManager;
        $this->twig = $twig;
    }

    public function index()
    {
        return $this->twig->render('signup/index.html.twig');
    }

    public function new()
    {
        $user = new User();

        /* CHECK DATA USER IN SESSION */
        if ($this->session->has('user') && $this->session->get('user') instanceof User) {
            /* GET DATA USER IN SESSION */
            $user = $this->session->get('user');
        } else {
            /* SET DATA USER IN SESSION */
            $this->session->set('user', $user);
        }

        return $this->twig->render('signup/new.html.twig', ['user' => $user]);
    }

    public function create(Request $request)
    {
        if ('POST' == $request->getMethod()) {
            $data = $request->getParsedBody();
            $user = $this->session->get('user');
            $user = $this->userManager->parseDataSignup($user, $data);

            // TODO:: VALIDATION BEFORE PERSIST

            $this->userManager->save($user);

            $responseApiPayment = $this->userManager->getResponseApiPayment($user);

            $paymentDataId = null;

            if (array_key_exists('paymentDataId', $responseApiPayment)) {
                $paymentDataId = $responseApiPayment['paymentDataId'];
                $user->setPaymentDataId($paymentDataId);
                $this->userManager->save($user);

                $this->session->set('paymentDataId', $paymentDataId);
            }

            /* REMOVE DATA USER FROM SESSION */
            $this->session->remove('user');

            $this->redirect('/signup/confirmed');
        }

        $this->redirect('/signup/new');
    }

    public function confirmed()
    {
        $paymentDataId = $this->session->get('paymentDataId', null);

        $this->session->remove('paymentDataId');

        if (is_null($paymentDataId)) {
            $this->redirect('/signup');
        }
        return $this->twig->render('signup/confirmed.html.twig', ['paymentDataId' => $paymentDataId]);
    }

    public function ajaxSaveStep(Request $request)
    {
        if ('POST' == $request->getMethod()) {
            $data = $request->getParsedBody();
            $user = $this->session->get('user');
            $user = $this->userManager->parseDataSignup($user, $data);
            $this->session->set('user', $user);
            return json_encode(['status' => 'OK', 'message' => 'SAVED']);
        }
    }
}
