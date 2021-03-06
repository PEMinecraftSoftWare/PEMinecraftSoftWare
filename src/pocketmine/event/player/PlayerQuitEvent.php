<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace pocketmine\event\player;

use pocketmine\event\TranslationContainer;
use pocketmine\Player;

/**
 * Called when a player leaves the server
 */
class PlayerQuitEvent extends PlayerEvent{
	public static $handlerList = \null;

	/** @var TranslationContainer|string */
	protected $quitMessage;
	/** @var string */
	protected $quitReason;

	/**
	 * @param Player                      $player
	 * @param TranslationContainer|string $quitMessage
	 * @param string                      $quitReason
	 */
	public function __construct(Player $player, $quitMessage, string $quitReason){
		$this->player = $player;
		$this->quitMessage = $quitMessage;
		$this->quitReason = $quitReason;
	}

	/**
	 * @param TranslationContainer|string $quitMessage
	 */
	public function setQuitMessage($quitMessage){
		$this->quitMessage = $quitMessage;
	}

	/**
	 * @return TranslationContainer|string
	 */
	public function getQuitMessage(){
		return $this->quitMessage;
	}

	/**
	 * @return string
	 */
	public function getQuitReason() : string{
		return $this->quitReason;
	}
}
