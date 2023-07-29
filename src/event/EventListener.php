<?php

namespace iMD14\CoinsAPI\event;

use iMD14\CoinsAPI\CoinsAPI;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;

class EventListener implements Listener
{
  private $plugin;
  public function __construct(CoinsAPI $plugin)
  {
    $this->plugin = $plugin;
  }

  public function onJoin(PlayerJoinEvent $event)
  {
    $player = $event->getPlayer();
    $config = new Config($this->plugin->getDataFolder() . "config.yml", Config::YAML);
    $players = new Config($this->plugin->getDataFolder() . "players.yml");
    if(!$players->exists($player->getName())){
      $players->set($player->getName(), $config->get("StartingAmount"));
      $players->save();
    }
  }
}
