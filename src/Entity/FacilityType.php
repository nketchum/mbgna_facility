<?php

namespace Drupal\mbgna_facility\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Facility type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "facility_type",
 *   label = @Translation("Facility type"),
 *   label_collection = @Translation("Facility types"),
 *   label_singular = @Translation("facility type"),
 *   label_plural = @Translation("facilities types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count facilities type",
 *     plural = "@count facilities types",
 *   ),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\mbgna_facility\Form\FacilityTypeForm",
 *       "edit" = "Drupal\mbgna_facility\Form\FacilityTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\mbgna_facility\FacilityTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   admin_permission = "administer facility types",
 *   bundle_of = "facility",
 *   config_prefix = "facility_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/facility_types/add",
 *     "edit-form" = "/admin/structure/facility_types/manage/{facility_type}",
 *     "delete-form" = "/admin/structure/facility_types/manage/{facility_type}/delete",
 *     "collection" = "/admin/structure/facility_types"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *   }
 * )
 */
class FacilityType extends ConfigEntityBundleBase {

  /**
   * The machine name of this facility type.
   *
   * @var string
   */
  protected $id;

  /**
   * The human-readable name of the facility type.
   *
   * @var string
   */
  protected $label;

}
