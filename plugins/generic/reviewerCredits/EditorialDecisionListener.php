<?php

namespace APP\plugins\generic\reviewerCredits;

use Illuminate\Events\Dispatcher;
use PKP\observers\events\DecisionAdded;
use PKP\plugins\PluginRegistry;

class EditorialDecisionListener
{


    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            DecisionAdded::class,
            [self::class, 'handleDecisionAdded']
        );
    }

    public function handleDecisionAdded(DecisionAdded $event)
    {
        $plugin = PluginRegistry::getPlugin('generic', 'reviewercreditsplugin');
        $plugin->callbackSendEditorDecision(null, null, $event);
    }


}
