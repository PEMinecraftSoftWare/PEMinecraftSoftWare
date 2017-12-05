<?php

/*
 * RakLib network library
 *
 *
 * This project is not affiliated with Jenkins Software LLC nor RakNet.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 */

declare(strict_types=1);

namespace raklib\protocol;

#include <rules/RakLibPacket.h>

class OpenConnectionRequest2 extends OfflineMessage{
	public static $ID = MessageIdentifiers::ID_OPEN_CONNECTION_REQUEST_2;

	/** @var int */
	public $clientID;
	/** @var string */
	public $serverAddress;
	/** @var int */
	public $serverPort;
	/** @var int */
	public $mtuSize;

	protected function encodePayload() : void{
		$this->writeMagic();
		$this->putAddress($this->serverAddress, $this->serverPort, 4);
		$this->putShort($this->mtuSize);
		$this->putLong($this->clientID);
	}

	protected function decodePayload() : void{
		$this->readMagic();
		$this->getAddress($this->serverAddress, $this->serverPort);
		$this->mtuSize = $this->getShort();
		$this->clientID = $this->getLong();
	}
}
