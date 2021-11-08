<?php
namespace princepines\ServerShowcase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\level\Position;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class main extends PluginBase implements Listener
{

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("Plugin enabled");
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
    }

    public function onDisable()
    {
        $this->getLogger()->info("Plugin disabled");
    }

    private int $timer = 5;
    private int $timer2 = 5;
    private int $timer3 = 5;
    private int $timer4 = 5;
    private int $timer5 = 5;


    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        switch ($command->getName()) {
            case "showcase":
                $arr1 = [];
                $arr2 = [];
                $arr3 = [];
                $arr4 = [];
                $arr5 = [];
                $config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
                if ($sender instanceof Player) {
                    $level = $this->getServer()->getLevelByName($config->get("showcase-world"));
                    $this->getServer()->loadLevel($config->get("showcase-world"));
                    $sender->teleport(new Position($config->get("Pos1", $arr1), $level));
                    $sender->sendPopup($config->get("Text1"));
                    $this->timer--;
                } elseif ($this->timer <= 0) {
                    $sender->teleport(new Position($config->get("Pos2", $arr2)));
                    $sender->sendPopup($config->get("Text2"));
                    $this->timer2--;
                } elseif ($this->timer2 <= 0) {
                    $sender->teleport(new Position($config->get("Pos3", $arr3)));
                    $sender->sendPopup($config->get("Text3"));
                    $this->timer3--;
                } elseif ($this->timer3 = 0) {
                    $sender->teleport(new Position($config->get("Pos4", $arr4)));
                    $sender->sendPopup($config->get("Text4"));
                    $this->timer4--;
                } elseif ($this->timer4 = 0) {
                    $sender->teleport(new Position($config->get("Pos5", $arr5)));
                    $sender->sendPopup($config->get("Text"));
                    $this->timer5--;
                } else {
                    $sender->sendPopup("Showcase is done, thank you for viewing.");
                    $level = $this->getServer()->getLevelByName($config->get("spawn-world"));
                    $sender->teleport($level->getSafeSpawn());
                }
                break;
            case "scver":
                $sender->sendMessage("ServerShowcase\nCreated by princepines\nversion 1.0.0\nhttps://github.com/Lycol50/ServerShowcase");
                $sender->sendMessage("You might want to check cucumb3r too?\nhttps://github.com/Lycol50/cucumb3r");
                break;
        }
        return true;
    }
}