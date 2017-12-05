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


use raklib\RakLib;

class OpenConnectionRequest1 extends OfflineMessage{
	public static $ID = MessageIdentifiers::ID_OPEN_CONNECTION_REQUEST_1;

	/** @var int */
	public $protocol = RakLib::PROTOCOL;
	/** @var int */
	public $mtuSize;

	protected function encodePayload() : void{
		$this->writeMagic();
		$this->putByte($this->protocol);
		$this->put(str_repeat(chr(0x00), $this->mtuSize - 18));
	}

	protected function decodePayload() : void{
		$this->readMagic();
		$this->protocol = $this->getByte();
		$this->mtuSize = strlen($this->get(true)) + 18;
	}
}