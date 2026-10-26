<?php

/**
 * ProviderController.php
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2016-2017 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

use DCL\Common\Session\SessionUtil;
use DCL\Common\Session\SessionWrapperFactory;
use DCL\Core\OEGlobalsBag;

/**
 * DefaultController is the entry point to the application
 *
 * @package DCL::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class ProviderController extends AppBasePortalController
{
    /**
     * Override here for any controller-specific functionality
     */
    protected function Init()
    {
        parent::Init();
    }

    /**
     * Display the home page for the application
     */
    public function Home()
    {
        $cpid = $cuser = 0;
        $session = SessionWrapperFactory::getInstance()->getActiveSession();
        if ($session->has('authUserID')) {
            $cuser = $session->get('authUserID');
        } else {
            header("refresh:4;url= ./provider");
            echo 'Shared session not allowed with Portal!!!  <br />Onsite portal is using this session<br />Destroying Onsite Portal session and logging it out........';
            SessionUtil::portalSessionCookieDestroy();
            exit;
        }

        $pid = OEGlobalsBag::getInstance()->get('pid');
        $this->Assign('cpid', $pid);
        $this->Assign('cuser', $cuser);

        $this->Render();
    }

    /**
     * Displayed when an invalid route is specified
     */
    public function Error404()
    {
        $this->Render();
    }

    /**
     * Display a fatal error message
     */
    public function ErrorFatal()
    {
        $this->Render();
    }

    public function ErrorApi404()
    {
        $this->RenderErrorJSON('An unknown API endpoint was requested.');
    }
}
