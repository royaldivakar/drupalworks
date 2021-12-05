<?php

namespace Drupal\timezone\Form;
 
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
 
class TimeZoneConfigInfo extends ConfigFormBase {

 
   protected function getEditableConfigNames()
   {
       return ['timezone.config.form'];
   }
 
   public function getFormId()
   {
       return 'timezone_form';
   }
 
   public function buildForm(array $form, FormStateInterface $form_state)
   {
       $config = $this->config('timezone.config.form');
 
       $form['country'] = [
           '#type' => 'textfield',
           '#title' => 'Country',
           '#description' => 'Country Name',
           '#default_value' => $config->get('country')
       ];

       $form['city'] = [
        '#type' => 'textfield',
        '#title' => 'City',
        '#description' => 'City Name',
        '#default_value' => $config->get('city')
       ];

       $form['timezone'] = [
        '#type' => 'select',
        '#title' => t('Time Zone'),
        '#description' => t('Select Timezone'),
        '#options' => [
            'America/Chicago' => 'America/Chicago',
            'America/New_York' => 'America/New_York',
            'Asia/Tokyo' => 'Asia/Tokyo',
            'Asia/Dubai' => 'Asia/Dubai',
            'Asia/Kolkata' => 'Asia/Kolkata',
            'Europe/Amsterdam' => 'Europe/Amsterdam',
            'Europe/Oslo' => 'Europe/Oslo',
            'Europe/London' => 'Europe/London'
        ],
        '#default_value' => $config->get('timezone')
      ];
       
      return parent::buildForm($form, $form_state);
    }
    
   public function submitForm(array &$form, FormStateInterface $form_state)
   {
       $country = $form_state->getValue('country');
       $city = $form_state->getValue('city');
       $timezone = $form_state->getValue('timezone');

       parent::submitForm($form, $form_state);
       $this->config('timezone.config.form')->set('country',$country)->save();
       $this->config('timezone.config.form')->set('city',$city)->save();
       $this->config('timezone.config.form')->set('timezone',$timezone)->save();
   }
}