<?php

namespace Drupal\jsonapi_model;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceModifierInterface;

/**
 * Adds api_json as known format.
 */
class JsonapiModelServiceProvider implements ServiceModifierInterface {

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {
    if ($container->has('http_middleware.negotiation') && is_a($container->getDefinition('http_middleware.negotiation')
        ->getClass(), '\Drupal\Core\StackMiddleware\NegotiationMiddleware', TRUE)
    ) {
      // @see https://www.ietf.org/id/draft-wright-json-schema-00.txt
      $container->getDefinition('http_middleware.negotiation')
        ->addMethodCall('registerFormat', [
          'schema_json',
          ['application/schema+json'],
        ]);
    }
  }

}
