<?php

namespace Sylphian\Layout\Widget;

use XF\Entity\Widget;
use XF\Widget\AbstractWidget;
use XF\Widget\WidgetRenderer;

class GuestWidget extends AbstractWidget
{
    public function render(Widget $widget = null): ?WidgetRenderer
    {
        $visitor = \XF::visitor();
        if ($visitor->user_id) return null;

        return $this->renderer('syl_guest_widget', [
            'widget' => $widget
        ]);
    }
}