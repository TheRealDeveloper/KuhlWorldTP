<?php

namespace tkm\KuhlWorldTp;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use tkm\KuhlWorldTp\commands\CityBuildCommand;
use tkm\KuhlWorldTp\commands\EndCommand;
use tkm\KuhlWorldTp\commands\FarmWeltCommand;
use tkm\KuhlWorldTp\commands\HubCommand;
use tkm\KuhlWorldTp\commands\NetherCommand;

class Main extends PluginBase{
    public static $instance;
    public static Config $commands;
    public static Config $worlds;
    public static Config $messages;

    public function onEnable(): void
    {
        self::$instance = $this;
        self::saveResource("commands.yml");
        self::saveResource("messages.yml");
        self::saveResource("worlds.yml");
        self::$commands = new Config($this->getDataFolder() . "commands.yml", 2);
        self::$worlds = new Config($this->getDataFolder() . "worlds.yml", 2);
        self::$messages = new Config($this->getDataFolder() . "messages.yml", 2);
        if(self::$worlds->get("citybuild") === "none"){

        }else {
            self::getServer()->getCommandMap()->register(self::$commands->getNested("cb.command"), new CityBuildCommand($this));
        }
        if(self::$worlds->get("nether") === "none"){

        }else {
            self::getServer()->getCommandMap()->register(self::$commands->getNested("nether.command"), new NetherCommand($this));
        }
        if(self::$worlds->get("end") === "none"){

        }else {
            self::getServer()->getCommandMap()->register(self::$commands->getNested("end.command"), new EndCommand($this));
        }
        if(self::$worlds->get("farmwelt") === "none"){

        }else {
            self::getServer()->getCommandMap()->register(self::$commands->getNested("fw.command"), new FarmWeltCommand($this));
        }
        if(self::$worlds->get("lobby") === "none"){

        }else {
            self::getServer()->getCommandMap()->register(self::$commands->getNested("hub.command"), new HubCommand($this));
        }
    }

    public static function getInstance() : self{
        return self::$instance;
    }
}
