<?php

namespace Drupal\bubblesort\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\bubblesort\Bubblesort;

/**
 * Class DefaultController.
 *
 * @package Drupal\bubblesort\Controller
 */
class DefaultController extends ControllerBase {

  /**
   * Main.
   *
   * @return string
   *   Return Hello string.
   */
  public function main() {

    $form = \Drupal::formBuilder()->getForm('Drupal\bubblesort\Form\BubblesortUIForm');
    $config = \Drupal::service('config.factory')->getEditable('bubblesort.settings');
    $bubblesort = new Bubblesort($config);

    $op = \Drupal::request()->request->get('op'); 

    if (isset($op)) {

      switch ($op) {

        // If Shuffle button, then shuffle deck
        case 'shuffle':
          $bubblesort->shuffle();
          break;

        // If Step button, then perform single sort operation
        case 'step':
          $bubblesort->step();
          break;

      } 

    }

    return [
      '#theme' => 'bubblesort_view',
      '#description' => 'Bubblesort view',
      '#set' => $config->get('set'),
      '#set_size' => $config->get('set_size'),
      '#pos' => $config->get('pos'),
      '#complete' => $bubblesort->check_complete(),
      '#attached' => [
        'library' =>  [
          'bubblesort/bubblesort'
        ],
      ],
    ];

  }

}
