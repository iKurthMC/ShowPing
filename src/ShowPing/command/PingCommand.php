<?php

namespace ShowPing\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as Format;

use ShowPing\Central;

class PingCommand extends Command {

    public $central;

    public function __construct(Central $central) {
        parent::__construct("ping", "show ping in the server");
        parent::setPermission("showping.command");
        $this->central = $central;
    }

    public function execute(CommandSender $sender, string $label, array $args) {
        if (!$sender instanceof Player) {
            $sender->sendMessage("Usage this command in-game");
            return;
        }

        if (!$sender->hasPermission("showping.command")) {
            $sender->sendMessage(Format::colorize("&aShowPing &r&8» &7you have don't not permissions for use this command"));
            return;
        }

        if (isset ($args[0])) {
            $player = $this->central->getServer()->getPlayerByPrefix(array_shift($args));
            $sender->sendMessage(Format::colorize("&aShowPing &r&8» &f{$player->getName()} &7ping is &f{$player->getNetworkSession()->getPing()}"));
            return;
        }

        if (!isset ($args[0])) {
            $sender->sendMessage(Format::colorize("&aShowPing &r&8» &fyou have &7{$sender->getNetworkSession()->getPing()} &fping"));
            return;
        }
    }
}