<?php

namespace iMD14\CoinsAPI;

use iMD14\CoinsAPI\event\EventListener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class CoinsAPI extends PluginBase
{

    public static $instance;

  public function onEnable(): void
  {
    @mkdir($this->getDataFolder());
    $this->saveResource("players.yml");
    $this->saveResource("config.yml");
    self::$instance = $this;
    $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
  }

    /**
     * @param Player $player
     * @return bool|mixed
     */
    public function getCoins(Player $player)
    {
      $config = new Config($this->getDataFolder() . "players.yml", Config::YAML);
      return $config->get($player->getName());
    }

    /**
     * @param Player $player
     * @param int $amount
     */
    public function addCoins(Player $player, int $amount)
    {
        $config = new Config($this->getDataFolder() . "players.yml", Config::YAML);

        $config->set(strtolower($player->getName()), $this->getCoins($player) + $amount);
        $config->save();
    }

    /**
     * @param Player $player
     * @param int $amount
     */
    public function removeCoins(Player $player, int $amount)
    {
        $config = new Config($this->getDataFolder() . "players.yml", Config::YAML);

        $config->set(strtolower($player->getName()), $this->getCoins($player) - $amount);
        $config->save();
    }

    /**
     * @param Player $player
     * @param int $amount
     */
    public function setCoins(Player $player, int $amount)
    {
        $config = new Config($this->getDataFolder() . "players.yml", Config::YAML);

        $config->set(strtolower($player->getName()), $amount);
        $config->save();
    }

    public static function getInstance(): self
    {
        return self::$instance;
    }

}