<?php

namespace Drupal\mbgna_facility\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\mbgna_facility\FacilityInterface;

/**
 * Defines the facility entity class.
 *
 * @ContentEntityType(
 *   id = "facility",
 *   label = @Translation("Facility"),
 *   label_collection = @Translation("Facilities"),
 *   label_singular = @Translation("facility"),
 *   label_plural = @Translation("facilities"),
 *   label_count = @PluralTranslation(
 *     singular = "@count facilities",
 *     plural = "@count facilities",
 *   ),
 *   bundle_label = @Translation("Facility type"),
 *   handlers = {
 *     "list_builder" = "Drupal\mbgna_facility\FacilityListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\mbgna_facility\FacilityAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\mbgna_facility\Form\FacilityForm",
 *       "edit" = "Drupal\mbgna_facility\Form\FacilityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "facility",
 *   admin_permission = "administer facility types",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "bundle",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "collection" = "/admin/content/facility",
 *     "add-form" = "/facility/add/{facility_type}",
 *     "add-page" = "/facility/add",
 *     "canonical" = "/facility/{facility}",
 *     "edit-form" = "/facility/{facility}/edit",
 *     "delete-form" = "/facility/{facility}/delete",
 *   },
 *   bundle_entity_type = "facility_type",
 *   field_ui_base_route = "entity.facility_type.edit_form",
 * )
 */
class Facility extends ContentEntityBase implements FacilityInterface {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['label'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Status'))
      ->setDefaultValue(TRUE)
      ->setSetting('on_label', 'Published')
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => FALSE,
        ],
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'boolean',
        'label' => 'above',
        'weight' => 0,
        'settings' => [
          'format' => 'enabled-disabled',
        ],
      ])
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

  /**
   * Overrides Drupal\Core\Entity\EntityBase->toLink() to add a simple
   * querystring when generating links. Helps autopopulate webforms.
   */
  public function toLink($text = NULL, $rel = 'canonical', array $options = []) {
    $options += ['query' => ['facility' => $this->id()]];
    return parent::toLink($text, $rel, $options);
  }

  /**
   * Overrides Drupal\Core\Entity\EntityBase->toUrl() to add a simple
   * querystring when generating canonical urls. Helps autopopulate webforms.
   */
  public function toUrl($rel = 'canonical', array $options = []) {
    $options += ['query' => ['facility' => $this->id()]];
    return parent::toUrl($rel, $options);
  }

}
