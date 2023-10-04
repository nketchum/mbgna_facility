<?php

namespace Drupal\mbgna_facility\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Url;

/**
 * Redirects facility urls by appending a querystring.
 * 
 * Requests are redirected if a facility's id is not present as querystring in
 * the url. For example, facility entity with an id of "1" will be redirected
 * from /facility/1 to /facility/1?facility=1.
 *
 * The reason for this unusual url format is to allow webforms to
 * prepopulate fields using querystrings; it cannot prepopulate using
 * normal url parameters.
 */
class FacilityRedirectSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
  */
  public function handle(RequestEvent $event) {
    $query = \Drupal::request()->query->get('facility');

    if (!$query) {
      $route_name = \Drupal::routeMatch()->getRouteName();

      if ($route_name == 'entity.facility.canonical') {
        $current_path = \Drupal::service('path.current')->getPath();
        $params = \Drupal\Core\Url::fromUserInput($current_path)->getRouteParameters();

        if (isset($params['facility'])) {
          $facility = \Drupal\mbgna_facility\Entity\Facility::load($params['facility']);
          $url = \Drupal\Core\Url::fromRoute($route_name, ['facility' => $facility->id()], ['query' => ['facility' => $facility->id()], 'absolute' => FALSE]);
          $response = new RedirectResponse($url->toString());
          $event->setResponse($response);
        }
      }
    }
  }

  /**
   * {@inheritdoc}
  */
  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = ['handle'];
    return $events;
  }

}
