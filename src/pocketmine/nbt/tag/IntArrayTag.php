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

namespace pocketmine\nbt\tag;

use pocketmine\nbt\NBT;

use pocketmine\utils\Binary;

class IntArrayTag extends NamedTag{

	/**
	 * IntArrayTag constructor.
	 *
	 * @param string $name
	 * @param int[]  $value
	 */
	public function __construct(string $name = "", array $value = []){
		parent::__construct($name, $value);
	}

	public function getType() : int{
		return NBT::TAG_IntArray;
	}

	public function read(NBT $nbt, bool $network = \false) : void{
		$size = ($network === \true ? Binary::readVarInt($nbt->buffer, $nbt->offset) : ($nbt->endianness === 1 ? (\unpack("N", $nbt->get(4))[1] << 32 >> 32) : (\unpack("V", $nbt->get(4))[1] << 32 >> 32)));
		$this->value = \array_values(\unpack($nbt->endianness === NBT::LITTLE_ENDIAN ? "V*" : "N*", $nbt->get($size * 4)));
	}

	public function write(NBT $nbt, bool $network = \false) : void{
		($nbt->buffer .=  $network === \true ? Binary::writeVarInt(\count($this->value)) : ($nbt->endianness === 1 ? (\pack("N", \count($this->value))) : (\pack("V", \count($this->value)))));
		($nbt->buffer .= \pack($nbt->endianness === NBT::LITTLE_ENDIAN ? "V*" : "N*", ...$this->value));
	}

	public function __toString(){
		$str = \get_class($this) . "{\n";
		$str .= \implode(", ", $this->value);
		return $str . "}";
	}

	/**
	 * @return int[]
	 */
	public function &getValue() : array{
		return parent::getValue();
	}

	/**
	 * @param int[] $value
	 *
	 * @throws \TypeError
	 */
	public function setValue($value) : void{
		if(!\is_array($value)){
			throw new \TypeError("IntArrayTag value must be of type int[], " . \gettype($value) . " given");
		}
		\assert(\count(\array_filter($value, function($v){
			return !\is_int($v);
		})) === 0);

		parent::setValue($value);
	}
}
