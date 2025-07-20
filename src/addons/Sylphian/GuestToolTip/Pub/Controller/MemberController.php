<?php

namespace Sylphian\GuestToolTip\Pub\Controller;

use XF\Pub\Controller\MemberController as XFMember;
use XF\Mvc\ParameterBag;

class MemberController extends XFMember
{
    public function actionTooltip(ParameterBag $params)
    {
        $this->assertNotEmbeddedImageRequest();

        $visitor = \XF::visitor();
        $hasPermission = $visitor->hasPermission('general', 'viewProfileToolTip');

        if ($hasPermission) {
            $user = $this->assertViewableUser($params->user_id, [], true);
            $viewParams = [
                'user' => $user,
                'hasPermission' => true
            ];
        } else {
            $viewParams = [
                'hasPermission' => false
            ];
        }

        return $this->view('XF:Member\Tooltip', 'member_tooltip', $viewParams);
    }
}