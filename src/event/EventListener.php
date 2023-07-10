<?php

namespace iMD14\CoinsAPI\event;

use iMD14\CoinsAPI\CoinsAPI;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\utils\Config;

class EventListener implements Listener
{
  private $plugin;
  public function __construct(CoinsAPI $plugin)
  {
    $this->plugin = $plugin;
  }

  public function onLogin(PlayerLoginEvent $event)
  {
    $player = $event->getPlayer();
    $config = new Config($this->plugin->getDataFolder() . "config.yml", Config::YAML);
    $config1 = new Config($this->plugin->getDataFolder() . "players.yml");
    if(!$config->exists($player->getName())){
      $config1->set($player->getName(), $config->get("StartingAmount"));
      $config1->save();
    }
  }
}
