<?php

namespace tkm\KuhlWorldTp\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\utils\CommandException;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;
use pocketmine\Server;
use tkm\KuhlWorldTp\Main;

class HubCommand extends Command implements PluginOwned{
    public function __construct(Main $plugin){
        $commands = Main::$commands;
        parent::__construct($commands->getNested("hub.command"), $commands->getNested("hub.description"), $commands->getNested("hub.usagemessage"), $commands->getNested("hub.aliases"));
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        $messages = Main::$messages;
        $worlds = Main::$worlds;
        if(!$sender instanceof Player){
            $sender->sendMessage($messages->get("noplayer"));
            return false;
        }
        Server::getInstance()->getWorldManager()->loadWorld($worlds->get("lobby"));
        $world = Server::getInstance()->getWorldManager()->getWorldByName($worlds->get("lobby"))->getSafeSpawn();
        $sender->teleport($world);
        $sender->sendMessage($messages->get("hubsucces"));
    }

    public function getOwningPlugin(): Plugin
    {
        return $this->plugin;
    }
}

