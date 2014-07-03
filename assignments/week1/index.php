<?php

	/**
	 * Here we assign two variables.
	 * Since whitespace is ignored, we might choose to impose
	 * some styling and align our assignments.
	 * Easier to read!
	 */
	$weight			= 150;
	$purchased		= true;

	/**
	 * This is a PHPDoc — a simple notation about what this
	 * function accepts (a bool) and what it returns (a float).
	 *
	 * @param bool
	 * @return float
	 */
	function getNewWeight($weight, $isPurchased) {
		if ($isPurchased) {
			$weight += 0.5;
		}

		return $weight;
	}

	/**
	 * Since getNewWeight() returns data, we can
	 * assign a variable to the function's return value.
	 */
	$newWeight = getNewWeight($weight, $purchased);

	var_dump($newWeight);


