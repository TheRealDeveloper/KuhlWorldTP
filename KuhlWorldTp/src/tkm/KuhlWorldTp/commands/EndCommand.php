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

class EndCommand extends Command implements PluginOwned{
    public function __construct(Main $plugin){
        $commands = Main::$commands;
        parent::__construct($commands->getNested("end.command"), $commands->getNested("end.description"), $commands->getNested("end.usagemessage"), $commands->getNested("end.aliases"));
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
        Server::getInstance()->getWorldManager()->loadWorld($worlds->get("end"));
        $world = Server::getInstance()->getWorldManager()->getWorldByName($worlds->get("end"))->getSafeSpawn();
        $sender->teleport($world);
        $sender->sendMessage($messages->get("endsucces"));
    }

    public function getOwningPlugin(): Plugin
    {
        return $this->plugin;
    }
}

