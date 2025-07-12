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

        if (!$visitor->user_id) {
            $viewParams = [
                'isGuest' => true,
            ];
        } else {
            $user = $this->assertViewableUser($params->user_id, [], true);
            $viewParams = [
                'user' => $user,
                'isGuest' => false
            ];
        }

        return $this->view('XF:Member\Tooltip', 'member_tooltip', $viewParams);
    }
}