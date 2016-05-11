<?php

namespace Drupal\bubblesort\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class BubblesortUIForm.
 *
 * @package Drupal\bubblesort\Form
 */
class BubblesortUIForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'bubblesort_ui_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['set'] = array(
      '#type' => 'submit',
      '#title' => $this->t('Set'),
    );
    $form['shuffle'] = array(
      '#type' => 'submit',
      '#title' => $this->t('Shuffle'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

}
