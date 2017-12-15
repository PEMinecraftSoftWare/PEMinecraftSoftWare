<?php
namespace pocketmine\log;

class log extends PluginBase implements Listener{
  private $conf;
  private $c;
  public function onEnable(){
    $this->conf = new Config(\pocketmine\Data."log.yml", Config::YAML, []);
    $this->c = $this->conf->getAll();
  }
  public function onDisable(){
    $this->conf->setAll($this->c);
    $this->conf->save();
  }
  public function setblock(BlockPlaceEvent $ev){
    $block = $ev->getBlockReplaced();
    $this->getLogger()->info($block->getVector); //출력
    $this->c[$this->getTime()] = 
  }
}
 ?>
