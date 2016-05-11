<?php

namespace Drupal\bubblesort\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SettingsForm.
 *
 * @package Drupal\bubblesort\Form
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'bubblesort.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('bubblesort.settings');
    $form['set_size'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Set Size'),
      '#description' => $this->t('We recommend a size between 5 and 15'),
      '#maxlength' => 5,
      '#size' => 5,
      '#default_value' => $config->get('set_size'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('bubblesort.settings')
      ->set('set_size', $form_state->getValue('set_size'))
      ->save();
  }

}
