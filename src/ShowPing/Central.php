<?php

namespace ShowPing;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use ShowPing\command\PingCommand;

class Central extends PluginBase implements Listener {

    public function onEnable(): void {
        $server = $this->getServer();
        $plugin = $server->getPluginManager();
        $plugin->registerEvents($this, $this);
        $command = $server->getCommandMap();
        $command->register("command", new PingCommand($this));
    }
}