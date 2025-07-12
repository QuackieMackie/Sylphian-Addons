<?php
namespace Sylphian\Help\Pages;

use XF\Mvc\Entity\ArrayCollection;
use XF\Pub\Controller\AbstractController;

class StaffPage
{
    public static function renderStaffList(AbstractController $controller, \XF\Mvc\Reply\View $view)
    {
        $finder = \XF::app()->finder('XF:User');
        $finder->with('Profile');

        $adminFinder = clone $finder;
        $adminUsers = $adminFinder
            ->where('is_admin', true)
            ->where('user_state', 'valid')
            ->order('username')
            ->fetch();

        $modFinder = clone $finder;
        $modUsers = $modFinder
            ->where('is_moderator', true)
            ->where('is_admin', false)
            ->where('user_state', 'valid')
            ->order('username')
            ->fetch();

        $view->setParam('adminUsers', $adminUsers);
        $view->setParam('modUsers', $modUsers);

    }
}