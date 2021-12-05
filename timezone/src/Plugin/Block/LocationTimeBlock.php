<?php


namespace Drupal\timezone\Plugin\Block;
 
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
*
* Provides a Custom Program Block
*
* @Block(
* 
*  id = "location_time_block",
*  admin_label = @Translation("Location Time Block"),
*  category = @Translation("Custom"),
* )
*/


class LocationTimeBlock extends BlockBase implements ContainerFactoryPluginInterface {
 
    protected $time_generator;

    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
        return new static(
          $configuration,
          $plugin_id,
          $plugin_definition,
          $container->get('time_generator_service')
        );
      }

      public function __construct(array $configuration, $plugin_id, $plugin_definition, $time_generator) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);
        $this->time_generator = $time_generator;
      }


    public function build(){

        $config = \Drupal::service('config.factory')->getEditable('timezone.config.form');
        $timezone = $config->get('timezone');
        $time = $this->time_generator->getTime($timezone);

        return array(
            '#theme' => 'block_timezone',
            '#timezone' => $timezone,
            '#time' => $time,
            '#cache' => [
              'tags' => [
                'config:timezone.config.form'
              ],
            ],
        );
    }

}