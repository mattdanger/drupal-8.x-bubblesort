<?php

namespace Drupal\bubblesort;

use \Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Bubblesort.
 */
class Bubblesort {

  const SET_SIZE = 15;
  const MIN = 0;
  const MAX = 100;

  private $set_size;
  private $min;
  private $max;
  private $pos;

  private $config;

  /** 
   * 
   */
  public function __construct($config) {

/*     $this->config = $config_factory->getEditable('bubblesort.settings'); */
    $this->config = $config;

    $this->set_size = $this->config->get('set_size') ?: static::SET_SIZE;
    $this->min = $this->config->get('min') ?: static::MIN;
    $this->max = $this->config->get('max') ?: static::MAX;
    $this->pos = 0;

  }

  
  /**
   * Generate a new set of unsorted data
   */
  function shuffle() {
  
    $set = array();
  
    while (count($set) < $this->set_size) {
      
      // Random value between $min and $max
      $rand = rand($this->min, $this->max);
  
      // Make sure this random value doesn't already exist in our dataset
      if (!in_array($rand, $set)) {
        $set[] = $rand;
      }
  
    }

    $this->pos = 0;

    $this->config
      ->set('set', $set)
      ->set('pos', $this->pos)
      ->save();

    return TRUE;
  
  }
  
  /**
   * Return bubble sort set
   */
  function step() {

    
    $pos = $this->config->get('pos');
    $set = $this->config->get('set');
    $size = count($set);

    // Compare values & swap if necessary
    if (isset($set[$pos+1]) && $set[$pos+1] > $set[$pos]) {
  
      // Swap numbers
      $tmp = $set[$pos];
      $set[$pos] = $set[$pos+1];
      $set[$pos+1] = $tmp;

      $this->config
        ->set('set', $set)
        ->save();
  
    }
  
    // Update position
    if ($pos == ($size-2)) {
  
      $this->config
        ->set('pos', 0)
        ->save();
  
    } else {
  
      $pos++;
      $this->config
        ->set('pos', $pos)
        ->save();
  
    }

  }

  /**
   * Check if data is completely sorted
   *
   * @returns bool
   */
  function check_complete() {

    // Copy the data
    $set = $this->config->get('set');;

    // Sort it
    $size = count($set);
    $sorted = $set;
    for ($i = 0; $i < $size; $i++) {
  
      for ($j = 0; $j < $size - 1 - $i; $j++) {
  
        if ($sorted[$j+1] > $sorted[$j]) {
  
          // Swap numbers
          $tmp = $sorted[$j];
          $sorted[$j] = $sorted[$j+1];
          $sorted[$j+1] = $tmp;
  
        }
  
      }
  
    }
    
    // Does the sorted data match the stored data?
    return ($set == $sorted);
  
  }

}
