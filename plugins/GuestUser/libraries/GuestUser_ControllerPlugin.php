<?php


class GuestUser_ControllerPlugin extends Zend_Controller_Plugin_Abstract
{

    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $this->_preventAdminAccess($request);
        $this->_warnUnconfirmedUsers($request);
        if(!is_admin_theme()):
          $this->_preventSiteAccess($request);
        endif;
    }

    protected function _preventSiteAccess($request)
    {
        $user = current_user();
        $allowAccess = false;
        $path = $request->getPathInfo();

        if($page = get_current_record('simple-pages-page',false)):
          $parents = $page->getAncestors();
          if($parents):
            var_dump($parents);
          endif;
        endif;

        /*if (0 === strpos($path, '/vrijwilligers')) {
          // prevent access to site for anyone not logged in, including guests.
          if (!$user && !$allowAccess){
            $this->_getRedirect()->gotoUrl(WEB_ROOT .'/users/login');
          }
        }*/
    }

    protected function _preventAdminAccess($request)
    {
        $user = current_user();
        // If we're logged in, then prevent access to the admin for guest users
        if ($user && $user->role == 'guest' && is_admin_theme()) {
            $this->_getRedirect()->gotoUrl(WEB_ROOT . '/guest-user/user/me');
        }
    }

    /**
     * GU can be configured to give immediate access to the site (i.e., before they've gotten their email and confirmed)
     * for a limited time. Warn them here if it's been more than 20 minutes
     * @param unknown_type $request
     */

    protected function _warnUnconfirmedUsers($request)
    {
        $user = current_user();
        if(get_option('guest_user_instant_access') == 1
                && $user && $user->role == 'guest'
                && $request->getPathInfo() != '/guest-user/user/stale-token'
                ) {
                $tokens = get_db()->getTable('GuestUserToken')->findBy(array('user_id'=>$user->id));
                if(!empty($tokens)) {
                    $token = $tokens[0];
                    $tokenCreated = new DateTime($token->created);
                    $diff = time() - $tokenCreated->format('U');
                    if(!$token->confirmed && $user->active && $diff > 1200) {
                        $this->_getRedirect()->gotoUrl(WEB_ROOT . '/guest-user/user/stale-token');
                    }
                }
        }

    }

    protected function _getRedirect()
    {
        return Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
    }
}


?>
